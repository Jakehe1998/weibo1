<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // HasApiTokens API 令牌修改功能， Notifiable 消息通知相关功能引用， HasFactory  模型工厂相关功能的引用， Authenticatable  授权相关功能的引用

    /**
     * The attributes that are mass assignable.
     * 过滤用户提交的字段
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * 隐藏用户敏感信息字段
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *  指定数据库字段使用的数据类型
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    * 生成用户头像
    * 头像 size 默认值 100
    * 通过 $this->attributes['email'] 获取用户邮箱
    * 使用 trim 方法剔除邮箱前后空白内容
    * 用 strtolower 方法将邮箱转换为小写
    * 将转码后的邮箱与链接、尺寸拼接完整的 URL 并返回
    */
    public function gravatar ($size = '100')
    {
      $hash = md5 (strtolower(trim($this->attributes['email'])));
      return "https://cdn.v2ex.com/gravatar/$hash?s=$size";
    }
}
