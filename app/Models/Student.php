<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;

    // 设置表名 同时给表起别名
    protected $table = "customer";
    protected $primaryKey = "id";
    // 软删除
    use SoftDeletes;

    // 关闭自动时间戳
    public $timestamps = false;

    // 使用自动时间戳
    // 设置存储的字段类型 U时间戳类型 Y-m-d H:i:s...
    protected $dateFormat="U";
    const CREATED_AT = "addtime"; // 添加字段名
    const UPDATED_AT = "updatetime"; // 修改字段名

    // 添加时设置不允许添加的字段
    protected $guarded = [];

    // 查询全部数据
    // 参数 : 要搜索的关键词
    public static function list($gets)
    {
        $obj = (new self())->setTable("s")
            ->from("customer as s")
            ->join("major as m", "s.m_id", "=", "m.id")
            ->select("m.major", "s.id", "s.name", "s.birthday", "s.sex", "s.age", 's.headimg');
        // 搜索判断
        if (isset($gets['key']) and $gets['key'] != '') {
            $obj->where("s.name", "like", "%{$gets['key']}%");
        }
        if (isset($gets['sex']) and $gets['sex'] != '') {
            $obj->where("s.sex", $gets['sex']);
        }
        if (isset($gets['mjs']) and $gets['mjs'] != '') {
            $obj->whereIn("s.m_id", $gets['mjs']);
        }
        // $list=$obj->get();
        // paginate(每页展示条数) 分页搜索
        // 得到的数据集对象中就有分页链接
        $list = $obj->paginate(10);
        return $list;
    }

    // 获取器
    public function getBirthdayAttribute($value)
    {
        return $value ? date("Y-m-d", $value) : '';
    }

    // 删除方法
    public static function del($id)
    {
        try {
            self::destroy($id);
            $arr = ['error' => 0, 'msg' => '删除成功'];
        } catch (\Exception $e) {
            dd($e);
            $arr = ['error' => 1, 'msg' => '系统错误', 'eMsg' => $e->getMessage()];
        }
        return $arr;
    }

    // 添加方法
    public static function add($post, $file)
    {
        try {
            unset($post['_token']);
            // 处理文件上传
            if ($file == null) { // 用户没传 直接返回错误信息
                return ['error' => 2, 'msg' => '请上传头像'];
            }
            // 将文件上传至某个盘 得到盘内路径
            $path = $file->store("photo", "ding");
            $post['headimg'] = $path;
            self::create($post);
            $arr = ['error' => 0, 'msg' => '添加成功'];
        } catch (\Exception $e) {
            $arr = ['error' => 1, 'msg' => '系统错误', 'eMsg' => $e->getMessage()];
        }
        return $arr;
    }

    // 生日修改器
    public function setBirthdayAttribute($value)
    {
        // 按字段名添值
        $this->attributes['birthday'] = strtotime($value);
    }
}
