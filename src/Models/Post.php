<?php

namespace Jdsf\MiniForum\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id','images','content'];

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'images' => 'array',
    ];

    public function comments()
    {
        return $this->hasMany(\Jdsf\MiniForum\Models\Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(\Jdsf\MiniForum\Models\User::class);
    }


    public function zan_users()
    {
        return $this->belongsToMany(
            \Jdsf\MiniForum\Models\User::class,//final model
            'zans',
            'post_id',
            'user_id'
        );
    }


}
