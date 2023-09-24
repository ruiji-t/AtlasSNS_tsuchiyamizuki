<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Ruleクラスの追加(ignore付きのuniqueの為)
use App\User;
use App\Post;

class UsersController extends Controller
{

    // 検索機能
    public function search(Request $request){

        $keyword = $request->input('keyword');

        // usersテーブル内であいまい検索
        if(!empty($keyword)){
            $users = User::where('username','like','%'.$keyword.'%')->get();
        }else{
            // 未検索 or 未入力で検索
            $users = User::all();
        }

        return view('users.search',['users'=>$users,'keyword'=>$keyword]);
    }

    // プロフィールページの表示
    public function profileView($id){

        // タップアイコンのユーザIDをもとにユーザ情報を取得
        $users = User::where('id',$id)->first();

        // Postモデル(postsテーブル)からユーザーのレコードを取得
        $posts = Post::where('user_id',$id)
         ->latest('updated_at')
         ->get();

        // users/profile.phpにレコードを送り表示させる
        return view('users.profile',['users'=>$users,'posts'=>$posts]);

    }

    // プロフィールの更新
    public function profileEdit(Request $request){

        // バリデーション設定
        $request->validate([
            'username' => 'required|min:2|max:12',
            'mail' => ['required','min:5','max:40',Rule::unique('users')->ignore(Auth::user()->id),'email'],
            'password' => 'required|min:8|max:20|alpha_num|confirmed',
            'password_confirmation' => 'required|min:8|max:20|alpha_num',
            'bio' => 'max:150',
            'image' => 'image|mimes:jpg,bmp,png,gif,svg',
        ]);

        $id = $request->input('id');
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio');

        // 画像ファイルがアップロードされた場合の処理
        if($request->hasFile('image')){

            $image = $request->file('image');
            $path = $image->store('public');

            User::where('id',$id)->update([
                'images' => basename($path)
            ]);
        }

        User::where('id',$id)->update([
            'username' => $username,
            'mail' => $mail,
            'password' => bcrypt($password),
            'bio' => $bio,
        ]);

        return redirect('/top');
    }
}
