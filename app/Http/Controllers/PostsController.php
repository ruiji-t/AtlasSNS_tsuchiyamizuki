<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 追記　「Auth::〇〇の使用」
use Illuminate\Support\Facades\Auth;
use App\Post;


class PostsController extends Controller
{
    // 投稿の表示
    public function index(){
        // return view('posts.index');

         $posts = Post::latest() -> get(); //Postモデル(postsテーブル)からレコード情報を取得
        return view('posts.index',['posts'=>$posts]);
    }

    // 投稿の登録
    public function postCreate(Request $request){
        // if($request->isMethod('post')){

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
        // }
        // return view('posts.index');
    }



}
