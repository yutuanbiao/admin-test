<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户登录 | 系统名称</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --error-color: #ef233c;
            --text-color: #2b2d42;
            --light-gray: #f8f9fa;
            --border-color: #dee2e6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: var(--primary-color);
            font-size: 28px;
            margin-bottom: 10px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: var(--error-color);
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid var(--error-color);
        }

        .alert-danger ul {
            list-style: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .captcha-container {
            display: flex;
            gap: 10px;
        }

        .captcha-container .form-control {
            flex: 1;
        }

        .captcha-img {
            height: 46px;
            border-radius: 8px;
            cursor: pointer;
            border: 1px solid var(--border-color);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            background-color: var(--secondary-color);
        }

        .footer-links {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        .footer-links a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .footer-links span {
            color: var(--border-color);
            margin: 0 10px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <h1>用户登录</h1>
    </div>

    @if($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/auth" method="post">
        @csrf
        <div class="form-group">
            <label for="username">用户名</label>
            <input type="text" id="username" name="user" class="form-control" placeholder="请输入用户名" required>
        </div>

        <div class="form-group">
            <label for="password">密码</label>
            <input type="password" id="password" name="pwd" class="form-control" placeholder="请输入密码" required>
        </div>

        <div class="form-group">
            <label for="captcha">验证码</label>
            <div class="captcha-container">
                <input type="text" id="captcha" name="code" class="form-control" placeholder="请输入验证码" required>
                <img src="{{ captcha_src('math') }}" alt="验证码" class="captcha-img" onclick="this.src='{{ captcha_src('math') }}?'+Math.random()">
            </div>
        </div>

        <button type="submit" class="btn">登 录</button>

        <div class="footer-links">
{{--            <a href="/forgot-password">忘记密码</a>--}}
{{--            <span>|</span>--}}
            <a href="/login/email">邮箱登入</a>
        </div>
    </form>
</div>
</body>
</html>
