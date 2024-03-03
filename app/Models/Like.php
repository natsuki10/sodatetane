<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'post_id'];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id'); // 'post_id'はLikeテーブルにあるPostの外部キーを指定
    }
}
