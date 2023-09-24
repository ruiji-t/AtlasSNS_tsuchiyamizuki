@extends('layouts.login')

@section('content')
<!-- ログインユーザーが自身のプロフィールにアクセスしたときのみ編集画面へ (if) -->
<!-- その他のユーザーのプロフィールにアクセスしたときは閲覧画面へ (else)-->
@if(Auth::id() == $users->id)
<div id="editProfile">
    <div class="edit_icon">
        <img src="{{ asset('storage/'.Auth::user()->images) }}">
    </div>
    <div class="edit_form">
        <form action="/users/update" method="post" enctype="multipart/form-data">

          <div class="edit_space">
          <label for="newUsername">user name</label>
          <input type="text" name="username" value="{{ $users->username }}" id="newUsername">
          </div>
          <div class="edit_space">
          <label for="newMail">mail adress</label>
          <input type="email" name="mail" value="{{ $users->mail }}"  id="newMail">
          </div>
          <div class="edit_space">
          <label for="newPassword">password</label>
          <input type="password" name="password" id="newPassword">
          </div>
          <div class="edit_space">
          <label for="passwordConfirmation">password confirm</label>
          <input type="password" name="password_confirmation" id="passwordConfirmation">
          </div>
          <div class="edit_space">
          <label for="newBio">bio</label>
          <textarea name="bio" id="newBio">{{ $users->bio }}</textarea>
          </div>
          <div>
          <label>icon image</label>
          <input type="file" name="image" class="edit_file" accept="image/jpeg, image/png, image/bmp, image/gif, image/svg+xml">
          </div>

          <input type="hidden" name="id" value="{{ $users->id }}">
          <input type="submit" class="update_button" value="更新">
          {{ csrf_field() }}
        </form>
    </div>
</div>

@else
<div id="userProfile">
<div class="profile_icon">
    <img src="{{ asset('storage/'. $users ->images ) }}">
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
                  <img src="{{ asset('storage/'. $post->user->images ) }}">
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
@endif
@endsection
