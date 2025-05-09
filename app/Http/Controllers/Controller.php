<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->init();
    }
    // 初始化方法
    public function init()
    {
//        dump(Session::all());
        // 登录验证
        if(!Session::has("admin")){
            echo showMessage(['success'=>'请登录','url'=>'/login','time'=>10]);
            exit;
        }
    }
}
