<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    // 追記　「データベースに登録・更新」　
    protected $fillable = ['following_id','followed_id'];

}
