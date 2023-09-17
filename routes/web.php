<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

Route::get('/logout','Auth\LoginController@logout');

//ログイン中のページ
Route::group(['middleware' => ['auth']],function(){

  Route::get('/top','PostsController@index'); // get→post

  // 投稿の登録
  Route::post('/posts/create','PostsController@postCreate');
  // 投稿の編集
  Route::get('/posts/{id}/update-form','PostsController@updateForm');
  // 投稿の更新
  Route::post('/posts/update','PostsController@postUpdate');
  // 投稿の削除
  Route::get('/posts/{id}/delete','PostsController@postDelete');

  // （ユーザー）検索機能
  Route::get('/search','UsersController@search');
  Route::post('/search','UsersController@search');

  // フォロー解除機能
  Route::get('/follow/{id}/delete','FollowsController@followDelete');
  // フォロー機能
  Route::get('/follow/{id}/create','FollowsController@follow');

  // フォローリスト
  Route::get('/follow-list','FollowsController@followList');
  // フォロワーリスト
  Route::get('/follower-list','FollowsController@followerList');

  // プロフィールページ
  Route::get('/users/{id}/profile','UsersController@profile');


});
