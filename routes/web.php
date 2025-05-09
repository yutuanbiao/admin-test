<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 客户列表首页
use App\Http\Controllers\Customer;

// 首页路由
Route::get('/', [Customer::class, "list"]);

// 登录处理路由
Route::post("auth", [\App\Http\Controllers\Login::class, "auth"]);
// 登录路由
Route::post('/auth/email', [AuthController::class, 'emailLogin']);
Route::post('/auth/send-code', [AuthController::class, 'sendEmailCode']);

Route::get("list", [Customer::class, "list"]);
// 添加表单
Route::get("add", [Customer::class, "add"]);
// 添加处理
Route::post("save", [Customer::class, "save"]);
Route::delete("del/{id}", [Customer::class, "del"]);

// 登录表单路由
Route::view("login", "login/index");



