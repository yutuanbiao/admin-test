<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加</title>
</head>
<body>
<h1>客户添加</h1>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/save" method="post" enctype="multipart/form-data">
    {{-- 在自己的表单中设置表单令牌 --}}
    @csrf
    姓名 : <input type="text" name="name"> <br>
    头像 : <input type="file" name="logo"> <br>
    性别 :
    <input type="radio" name="sex" value="男"> 男
    <input type="radio" name="sex" value="女"> 女 <br>
    年龄 : <input type="number" name="age"> <br>
    生日 : <input type="date" name="birthday"> <br>
    部门 :
    <select name="m_id" id="">
        @foreach($majors as $v)
        <option value="{{$v['id']}}">{{$v['major']}}</option>
        @endforeach
    </select> <br>
    <button>添加</button>
</form>
</body>
</html>
