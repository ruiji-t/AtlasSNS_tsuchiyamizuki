@extends('layouts.login')

@section('content')
<!-- ユーザー検索フォーム -->
<div id="searchForm">
  <form action="/search"  method="post">
    @csrf
    <input type="text" name="keyword" class="search_form" placeholder="ユーザー名">
    <input type="image" class="search_button" src="images/search.png">
  </form>
  <div class="searched_word">
    @if(!empty($keyword))
      <p>検索ワード：{{ $keyword }}</p>
    @endif
  </div>
</div>

<!-- ユーザー検索結果一覧 -->
<div id="hitUser">
  @foreach($users as $user)
   <!-- ログインユーザー以外を表示 -->
   @if(Auth::id() != $user->id)
    <table class="user_situation">
      <tr>
      <td class="searched_icon"><img src="{{ asset('storage/'.$user->images) }}"></td>
      <td class="searched_name">{{ $user->username }}</td>
      <td class="follow_situation">

          <!-- フォロー状態の判断 -->
          @if(Auth::user()->isFollowing($user->id))
          <a href="/follow/{{$user->id}}/delete" class="follow_off">フォロー解除</a>
          @else
          <a href="/follow/{{$user->id}}/create" class="follow_on">フォローする</a>
          @endif

      </td>
      </tr>
    </table>
    @endif
  @endforeach
</div>

@endsection
