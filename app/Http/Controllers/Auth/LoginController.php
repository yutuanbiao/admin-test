<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // 显示邮箱登录表单
    public function showEmailLoginForm()
    {
        return view('auth.email-login');
    }

    // 发送验证码
    public function sendVerificationCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // 存储验证码（5分钟有效）
        Cache::put('login_code_'.$email, $code, now()->addMinutes(5));

        // 发送邮件
        Mail::to($email)->send(new VerificationCodeMail($code));

        return back()->with('status', '验证码已发送至您的邮箱');
    }

    // 验证码登录
    public function verifyCodeLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code'  => 'required|digits:6'
        ]);

        $email = $request->email;
        $code = $request->code;

        // 验证码校验
        if (Cache::get('login_code_'.$email) !== $code) {
            return back()->withErrors(['code' => '验证码错误或已过期']);
        }

        // 自动创建用户（如果不存在）
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name'     => explode('@', $email)[0], // 自动生成用户名
                'password' => bcrypt(Str::random(16)) // 生成随机密码
            ]
        );

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
