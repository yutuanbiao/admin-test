<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/index.css">
    <title>客户列表</title>
</head>
<body>
    <h1>客户列表</h1>
    <form action="/list" method="get">
        姓名 : <input type="text" name="key" id="nameInput" value="{{$gets['key']??''}}">
        性别 : <input type="radio" name="sex" value="男" {{($gets['sex']??'')=='男'?'checked':''}}> 男
        <input type="radio" name="sex" value="女" {{($gets['sex']??'')=='女'?'checked':''}}> 女
        <br>
        部门 :
        @foreach($majors as $v)
        <input type="checkbox" name="mjs[]" value="{{$v['id']}}" {{in_array($v['id'],($gets['mjs']??[]))?'checked':''}}> {{$v['major']}}
        @endforeach
        <br>
        <button>搜索</button>
        <button type="button" onclick="clearInput()" class="btn-clear">清空</button>
    </form>
    <br>
    <a href="/add">添加</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>头像</th>
            <th>生日</th>
            <th>性别</th>
            <th>年龄</th>
            <th>部门</th>
            <th>操作</th>
        </tr>
        @forelse($list as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v['name']}}</td>
            <td>
                <img src="/uploads/{{$v['headimg']}}" alt="" width="50" height="50">
            </td>
            <td>{{$v['birthday']}}</td>
            <td>{{$v['sex']}}</td>
            <td>{{$v['age']}}</td>
            <td>{{$v['major']}}</td>
            <td>
                {{-- 删除跳页时携带搜索条件--}}
                {{-- http_build_query(数组) 将数组转为地址栏参数--}}
{{--                <a href="/del/{{$v['id']}}?{{http_build_query($gets)}}">删除</a>--}}
                <form action="/del/{{ $v['id'] }}?{{ http_build_query($gets) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')  <!-- 伪造 DELETE 方法 -->
                    <button type="submit" class="link-style-button">删除</button>
                </form>
                <a href="">修改</a>
            </td>
        </tr>
        @empty
            <tr>
                <th colspan="8">暂无数据</th>
            </tr>
        @endforelse
        <tr>
            <td colspan="8" style="text-align: center">
                {{-- 数据集对象中的links方法获取分页链接 --}}
                {{-- 使用withQueryString将分页链接中携带搜索参数 --}}
                {{$list->withQueryString()->links()}}
            </td>
        </tr>
    </table>
</body>

<script>
    function clearInput() {
        // 通过 ID 获取输入框元素并清空值
        document.getElementById('nameInput').value = '';
    }
</script>

</html>
