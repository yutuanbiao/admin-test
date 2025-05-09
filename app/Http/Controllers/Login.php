<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

class Login extends Controller
{
    public function init()
    {
    }

    /**
     * 登录表单验证
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\Vie
     */
    public function auth(LoginRequest $request)
    {
        // 接值
        $post = $request->post();
//        dump($post);
        $rt = Admin::checkLogin($post);
//        dump($rt);
        if ($rt['error'] == 0) {
            // 存储session
            Session::put("admin", $rt['info']);
            return showMessage(['success' => $rt['msg'], 'url' => '/list', 'time' => 10]);
        } else {
            return showMessage(['error' => $rt['msg'], 'time' => 5]);
        }
    }

}
