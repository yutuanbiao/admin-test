<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 开启bootstrap分页样式
        Paginator::useBootstrap();
        // 日志记录sql语句
        DB::listen(function ($query){
            Log::info($query->sql);
        });
        // 设置自定义验证方法
        Validator::extend("sex",function ($attr,$value,$params){
            return ($value=="男" or $value=="女");
        });
    }
}
