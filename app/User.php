<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // user(1)-post(多)のリレーション
    public function posts(){
        return $this->hasMany('App\Post');
    }


    // フォロー機能 多対多のリレーション

    // フォローする(follows)関係性　1対多
    public function follows(){
        return $this->belongsToMany('App\User', 'follows','following_id','followed_id') -> withTimestamps();
    }

    // フォローされる(followers)関係性　1対多
    public function followers(){
        return $this->belongsToMany('App\User', 'follows','followed_id','following_id') -> withTimestamps();
    }

    // ログインユーザーは他ユーザー（$user_id）をフォローしていれば(レコードがあれば)真を返す関数
    public function isFollowing(Int $user_id){
        return (bool) $this->follows()->where('followed_id',$user_id)->first();
    }

}
