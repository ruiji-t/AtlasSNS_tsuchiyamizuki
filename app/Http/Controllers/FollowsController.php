<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\Post;
use App\User;

class FollowsController extends Controller
{
    // フォローリストの表示
    public function followList(){

        // ログインユーザーがフォローしているユーザーIDを取得
        $login_id = Auth::user()->id;
        $followed_ids = Follow::where('following_id',$login_id)->get('followed_id');

        // フォローユーザー情報を取得
        $follows = User::whereIn('id',$followed_ids)->get();

        // Postモデル(postsテーブル)からフォローユーザーのレコードを取得
         $posts = Post::whereIn('user_id',$followed_ids)
         ->latest('updated_at')
         ->get();

        // follows/followList.phpにレコードを送り表示させる
        return view('follows.followList',['follows'=>$follows,'posts'=>$posts]);
    }


    public function followerList(){

        // ログインユーザーのフォロワーIDを取得
        $login_id = Auth::user()->id;
        $follower_ids = Follow::where('followed_id',$login_id)->get('following_id');

        // フォロワー情報を取得
        $followers = User::whereIn('id',$follower_ids)->get();

        // Postモデル(postsテーブル)からフォロワーのレコードを取得
         $posts = Post::whereIn('user_id',$follower_ids)
         ->latest('updated_at')
         ->get();

        // follows/followerList.phpにレコードを送り表示させる
        return view('follows.followerList',['followers'=>$followers,'posts'=>$posts]);
    }


    // フォロー解除機能（検索ページ・プロフィールページ）
    public function followDelete($id){
        $follower = Auth::user();
        $follow_judge = $follower->isFollowing($id);

        if($follow_judge){

            $follower_id = $follower->id;
            $followed_id = $id;

            Follow::where([
                ['following_id','=',$follower_id],
                ['followed_id','=',$followed_id]])->delete();
        }
        return back();
    }

    // フォロー機能（検索ページ・プロフィールページ）
    public function follow($id){

        $follower = Auth::user();
        $follow_judge = $follower->isFollowing($id);

        if(!$follow_judge){

            $follower_id = $follower->id;
            $followed_id = $id;

            Follow::create([
                'following_id'=> $follower_id,
                'followed_id' => $followed_id,
            ]);
            return back();
        }
    }



}
