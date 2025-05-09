<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginCodeMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // 密码登录
    public function authenticate(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'pwd' => 'required',
            'code' => 'required|captcha'
        ]);

        // 这里添加你的密码登录逻辑
        // ...

        return redirect('/dashboard');
    }

    // 邮箱登录
    public function emailLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'email_code' => 'required|digits:6'
        ]);

        $email = $request->input('email');
        $code = $request->input('email_code');

        // 验证验证码
        $cacheKey = 'login_code_' . $email;
        $correctCode = Cache::get($cacheKey);

        if (!$correctCode || $correctCode != $code) {
            return back()->withErrors(['email_code' => '验证码错误或已过期']);
        }

        // 验证通过后清除验证码
        Cache::forget($cacheKey);

        // 这里添加你的邮箱登录逻辑
        // 例如: 查找用户或创建新用户
        // $user = User::firstOrCreate(['email' => $email], [...]);
        // auth()->login($user);

        return redirect('/dashboard');
    }

    // 发送邮箱验证码
    public function sendEmailCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->input('email');
        $code = Str::random(6, '1234567890'); // 生成6位数字验证码

        // 存储验证码到缓存，有效期15分钟
        $cacheKey = 'login_code_' . $email;
        Cache::put($cacheKey, $code, now()->addMinutes(15));

        // 发送邮件
        try {
            Mail::to($email)->send(new LoginCodeMail($code));
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => '邮件发送失败: ' . $e->getMessage()]);
        }
    }
}
