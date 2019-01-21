<?php

namespace Jdsf\MiniForum\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id','post_id','parent_id','content'];

    public function comment_user()
    {
        return $this->belongsTo(\Jdsf\MiniForum\Models\User::class, 'user_id', 'id');
    }


    public function parent()
    {
        return $this->belongsTo(static::class);
    }
}
