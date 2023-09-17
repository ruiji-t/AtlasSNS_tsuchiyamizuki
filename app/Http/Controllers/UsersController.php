<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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

    // プロフィールページ
    public function profile(){
        return view('users.profile');
    }
}
