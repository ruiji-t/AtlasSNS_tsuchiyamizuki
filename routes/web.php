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
  Route::post('/post/create','PostsController@postCreate');

  Route::get('/profile','UsersController@profile');

  Route::get('/search','UsersController@search');

  Route::get('/follow-list','PostsController@index');
  Route::get('/follower-list','PostsController@index');


});
