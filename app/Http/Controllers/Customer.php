<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRquest;
use App\Models\Customer as CustomerModel;
use App\Models\Major;
use Illuminate\Http\Request;

class Customer extends Controller
{

    // 首页
    // 参数绑定获取请求对象  Illuminate\Http\Request
    public function list(Request $request)
    {
        // 使用请求对象接get值  query方法获取地址栏参数
        $gets = $request->query();
        // 查询学生信息
        // 模型得到的结果为模型对象
        $list = CustomerModel::list($gets);
        // 查询全部的部门
        $majors = Major::get();
        return view(
            "customer/list",
            ['list' => $list, "gets" => $gets, 'majors' => $majors]
        );
    }

    // 删除方法
    public function del($id, Request $request)
    {
        // 接搜索条件(地址栏参数)
        $gets = $request->query();
        $rt = CustomerModel::del($id);
        if ($rt['error'] == 0) { // 跳页至首页 同时带回搜索条件
            return showMessage(['success' => $rt['msg'], 'url' => '/list?' . http_build_query($gets), 'time' => 10]);
        } else { // 返回上一页
            return showMessage(['error' => $rt['msg'], 'time' => 10]);
        }
    }

    // 添加表单页
    public function add()
    {
        // 查询全部部门
        $majors = Major::get();
        return view(
            "customer/add",
            ['majors' => $majors]
        );
    }
    // 添加处理页
    // 在接收请求时 同时对数据进行验证
    // 基础请求类 只能验证表单令牌
    // 验证数据 需要自定义请求类
    public function save(CustomerRquest $request)
    {
        // 接值
        $post = $request->post(); // 数据数组
        // 文件上传信息
        $file = $request->file("logo");

        $rt = CustomerModel::add($post, $file);
        if ($rt['error'] == 0) { // 跳页至首页 同时带回搜索条件
            return showMessage(['success' => $rt['msg'], 'url' => '/list', 'time' => 10]);
        } else { // 返回上一页
            return showMessage(['error' => $rt['msg'], 'time' => 10]);
        }
    }

    //暂时不处理，略
    public function edit(Request $request)
    {
        //1.先获取请求参数id
        //2、根据id获取数据，渲染到视图view
        //3、修改后的数据post请求更新--安全验证，前后两次id是否一致

    }
}
