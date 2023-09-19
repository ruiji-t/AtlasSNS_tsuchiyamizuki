@extends('layouts.login')

@section('content')
<div id="userProfile">
<div class="profile_icon">
    <img src="{{ asset('images/'. $users ->images ) }}">
  </div>
  <div class="profile_items">
    <p>name</p>
    <p>bio</p>
  </div>
  <div class="profile_contents">
    <p>{{ $users ->username }}</p>
    <p>{{ $users ->bio }}</p>
  </div>
  <div class="follow_situation">
    <!-- フォロー状態の判断 -->
          @if(Auth::user()->isFollowing($users->id))
          <a href="/follow/{{$users->id}}/delete" class="follow_off">フォロー解除</a>
          @else
          <a href="/follow/{{$users->id}}/create" class="follow_on">フォローする</a>
          @endif
  </div>
</div>
<div id="threadArea">
  @foreach($posts as $post)
        <div class="thread_container">
            <div class="posted_icon">
                  <img src="{{ asset('images/'. $post->user->images ) }}">
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
