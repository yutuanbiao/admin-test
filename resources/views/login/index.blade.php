<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户登录</title>
</head>
<body>
    <h1>登录</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/auth" method="post">
        @csrf
        用户名 : <input type="text" name="user"> <br>
        密码 : <input type="password" name="pwd"> <br>
        验证码 : <input type="text" name="code" >
        <img src="{{captcha_src("math")}}" alt=""> <br>
        <button>登录</button>
    </form>
</body>
</html>
