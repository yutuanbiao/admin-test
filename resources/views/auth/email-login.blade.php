<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>邮箱登录</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-card {
            max-width: 400px;
            margin: 5rem auto;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .countdown {
            color: #6c757d;
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <div class="login-card bg-white">
        <h2 class="mb-4 text-center">邮箱登录</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login.verify-code') }}">
            @csrf

            <!-- 邮箱输入 -->
            <div class="mb-3">
                <label for="email" class="form-label">邮箱地址</label>
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       name="email"
                       required
                       autofocus>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- 验证码输入 -->
            <div class="mb-4">
                <label for="code" class="form-label">验证码</label>
                <div class="input-group">
                    <input type="text"
                           class="form-control @error('code') is-invalid @enderror"
                           id="code"
                           name="code"
                           required
                           placeholder="6位数字验证码">
                    <button type="button"
                            class="btn btn-outline-primary"
                            onclick="sendCode()"
                            id="sendCodeBtn">
                        获取验证码
                    </button>
                </div>
                @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">立即登录</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function sendCode() {
        const email = document.getElementById('email').value;
        const btn = document.getElementById('sendCodeBtn');

        if (!email) {
            alert('请输入邮箱地址');
            return;
        }

        // 禁用按钮并开始倒计时
        let seconds = 60;
        btn.disabled = true;

        const timer = setInterval(() => {
            btn.textContent = `${seconds}秒后重发`;
            if (seconds-- <= 0) {
                clearInterval(timer);
                btn.disabled = false;
                btn.textContent = '获取验证码';
            }
        }, 1000);

        // 发送请求
        fetch('{{ route("login.send-code") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: email })
        })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('发送失败，请重试');
                    clearInterval(timer);
                    btn.disabled = false;
                    btn.textContent = '获取验证码';
                }
            });
    }
</script>
</body>
</html>
