@extends('layouts.login')

@section('content')
 <!-- 投稿フォーム -->
            <div id="postForm">
                <div class="posting_icon">
                    <img src="images/{{ Auth::user()->images}}">
                </div>
                <div class="post_form">
                    {!! Form::open(['url' => '/posts/create']) !!}
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
            <div class="posted_info">
                <div class="posted_date">
                    {{ $post->updated_at }}
                </div>
                <!-- ログインユーザーと投稿者が一致の場合のみ更新・削除ボタンを表示 -->
                @if( Auth::id() == $post->user_id )
                <div class="content">
                    <!-- 投稿の編集ボタン -->
                    <div class="edit_btn">
                    <a class="js-modal-open edit" href="/posts/{{$post->id}}/update-form" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png"></a>
                    </div>
                    <!-- 投稿の削除ボタン -->
                    <div class="trash_btn">
                    <a class="trash" href="/posts/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
                        <img src="images/trash.png" alt="削除ボタン1">
                        <img src="images/trash-h.png" alt="削除ボタン2">
                    </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
  @endforeach
  <!-- モーダルの中身 -->
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
           <form action="/posts/update" method="post">
                <textarea name="update_content" class="modal_post"></textarea>
                <input type="hidden" name="update_id" class="modal_id" value="">
                <!-- <input type="submit" value="更新"> -->
                <input type="image" class="update_submit" src="images/edit.png">
                {{ csrf_field() }}
           </form>
           <!-- <a class="js-modal-close" href="">閉じる</a> -->
        </div>
    </div>
</div>





@endsection
