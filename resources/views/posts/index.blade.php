@extends('layouts.login')

@section('content')
 <!-- 投稿フォーム -->
            <div id="postForm">
                <div class="posting_icon">
                    <img src="images/{{ Auth::user()->images}}">
                </div>
                <div class="post_form">
                    {!! Form::open(['url' => '/post/create']) !!}
                    {{ Form::input('textarea','post_content',null,['class' => 'post_area','cols' => '50','rows' => '3','placeholder'=>'投稿内容を入力してください。']) }}
                    <input type="image" class="post_submit" src="images/post.png">
                    {!! Form::close() !!}
                </div>
            </div>

<!-- 投稿一覧 -->
<div id="threadArea">
  @foreach($posts as $post)
        <div class="thread_container">
            <div class="posted_icon">
              <img src="images/{{ $post->user->images }}">
            </div>
            <div class="posted_content">
                <p class="name">{{ $post->user->username }}</p>
                <p class="comment">{{ $post->post }}</p>
            </div>
            <div class="posted_date">
                {{ $post->created_at }}
            </div>
        </div>
  @endforeach
</div>





@endsection
