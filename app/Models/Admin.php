<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Admin extends Model
{
    use HasFactory;

    protected $table = "admin";
    protected $primaryKey = "id";

    public $timestamps = false;

    public static function checkLogin($post)
    {
        try {
            $one = self::where("admin", $post['user'])
                ->where("pwd", md5(md5($post['pwd'])))
                ->first();
            if ($one) {
                // 修改登录次数/时间/ip...
                $data = [
                    'loginip' => Request::ip(),
                    'logintime' => time(),
                    'times' => DB::raw('times+1')
                ];
                self::where("id", $one->id)->update($data);
                $arr = ['error' => 0, 'msg' => '登录成功', 'info' => $one];
            } else {
                $arr = ['error' => 1, 'msg' => '用户名或者密码错误'];
            }
        } catch (\Exception $e) {
            $arr = ['error' => 2, 'msg' => '系统错误', 'eMsg' => $e->getMessage()];
        }
        return $arr;
    }
}
