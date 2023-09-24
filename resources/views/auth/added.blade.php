@extends('layouts.logout')

@section('content')
<header>
    <div class="added_title">
      <h1>
        <a href="/top">
          <img src="{{asset('images/atlas.png')}}">
        </a>
      </h1>
      <p>Social Network Service</p>
    </div>
</header>

<div id="clear_container">
  <p> {{ session('username') }} さん</p>
  <p>ようこそ！AtlasSNSへ</p>
  <p>ユーザー登録が完了いたしました。</p>
  <p>早速ログインをしてみましょう！</p>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
