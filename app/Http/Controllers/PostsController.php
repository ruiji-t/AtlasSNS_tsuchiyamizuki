<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 追記　「Auth::〇〇の使用」
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Follow;

class PostsController extends Controller
{
    // 投稿の表示
    public function index(){
        // return view('posts.index');

        $login_id = Auth::user()->id;

        // ログインユーザーがフォローしているユーザーIDを取得
        $followed_ids = Follow::where('following_id',$login_id)->get('followed_id');

        // フォローしているユーザーIDの配列にログインユーザーIDを追加
        $followed_ids[] = $login_id;

        // Postモデル(postsテーブル)から
        // ログインユーザーとそのフォローユーザーらのレコードを取得
         $posts = Post::whereIn('user_id',$followed_ids)
         ->latest('updated_at')
         ->get();
        // posts/index.blade.phpにレコードを送り表示させる
        return view('posts.index',['posts'=>$posts]);
    }

    // 投稿の登録
    public function postCreate(Request $request){

            // バリデーション設定
            $request->validate([
                'post_content' => 'required|min:1|max:150'
            ]);

            $post = $request->input('post_content');
            $user_id = Auth::user()->id;

            Post::create([
                'user_id' => $user_id,
                'post' => $post,
            ]);

            return redirect('/top');

    }

    // 投稿の編集
    public function updateForm($id){
        $post = Post::where('id',$id)->first();
        return view('posts.updateForm',['post'=>$post]);
    }

    // 投稿の更新
    public function postUpdate(Request $request){

        // バリデーション設定
        $request->validate([
            'update_content' => 'required|min:1|max:150'
        ]);

        $id = $request->input('update_id');
        $update_post = $request->input('update_content');

        Post::where('id',$id)->update([
            'post' => $update_post
        ]);
        return redirect('/top');
    }

    // 投稿の削除
    public function postDelete($id){
        Post::where('id',$id)->delete();
        return redirect('/top');
    }


}
