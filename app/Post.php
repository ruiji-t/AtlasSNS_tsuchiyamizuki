<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 追記　「データベースに登録・更新」　
    protected $fillable = [
        'user_id','post'
    ];

    // post(多)-user(1)のリレーション
    public function user(){
        return $this->belongsTo('App\User');
    }
}
