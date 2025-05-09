<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加客户</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .custom-alert {
            max-width: 800px;
            margin: 1rem auto;
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <h1 class="text-center my-5">添加客户信息</h1>

    @if($errors->any())
        <div class="alert alert-danger custom-alert">
            <h5 class="alert-heading">提交信息时遇到以下错误：</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <form action="/save" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- 姓名 -->
                <div class="col-md-6">
                    <label for="name" class="form-label">姓名</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="请输入姓名">
                </div>

                <!-- 年龄 -->
                <div class="col-md-6">
                    <label for="age" class="form-label">年龄</label>
                    <input type="number" class="form-control" id="age" name="age" min="0" max="120">
                </div>

                <!-- 性别 -->
                <div class="col-md-6">
                    <label class="form-label">性别</label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sex" id="male" value="男">
                            <label class="form-check-label" for="male">男</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sex" id="female" value="女">
                            <label class="form-check-label" for="female">女</label>
                        </div>
                    </div>
                </div>

                <!-- 生日 -->
                <div class="col-md-6">
                    <label for="birthday" class="form-label">生日</label>
                    <input type="date" class="form-control" id="birthday" name="birthday">
                </div>

                <!-- 部门 -->
                <div class="col-md-6">
                    <label for="m_id" class="form-label">部门</label>
                    <select class="form-select" id="m_id" name="m_id">
                        @foreach($majors as $v)
                            <option value="{{$v['id']}}">{{$v['major']}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- 头像 -->
                <div class="col-md-6">
                    <label for="logo" class="form-label">头像上传</label>
                    <input class="form-control" type="file" id="logo" name="logo" accept="image/*">
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-primary px-4">提交信息</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
