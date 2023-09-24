@extends('layouts.login')

@section('content')
<!-- アイコン一覧 -->
<div id="listIcon">
  <div class="title_box">
    <p class="list_title">Follower List</p>
  </div>
  <div class="icon_spot">
    @foreach($followers as $follower)
        <a href="/users/{{ $follower->id }}/profile">
            <img src="{{ asset('storage/'.$follower->images ) }}">
        </a>
    @endforeach
  </div>
</div>
<!-- フォローユーザーの投稿一覧 -->
<div id="threadArea">
  @foreach($posts as $post)
        <div class="thread_container">
            <div class="posted_icon">
              <a href="/users/{{ $post->user_id }}/profile">
                  <img src="{{ asset('storage/'.$post->user->images ) }}">
              </a>
            </div>
            <div class="posted_content">
                <p class="name">{{ $post->user->username }}</p>
                <p class="comment">{{ $post->post }}</p>
            </div>
            <div class="posted_info">
                <div class="posted_date">
                    {{ $post->updated_at }}
                </div>
            </div>
        </div>
  @endforeach
</div>

@endsection
