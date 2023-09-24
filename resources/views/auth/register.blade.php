@extends('layouts.logout')

@section('content')
<header>
    <div class="register_title">
      <h1>
        <a href="/top">
          <img src="{{asset('images/atlas.png')}}">
        </a>
      </h1>
      <p>Social Network Service</p>
    </div>
</header>

<div id="register_container">

<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<p>新規ユーザー登録</p>

@if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif

{{ Form::label('user name') }}
{{ Form::text('username',null,['class' => 'new_input']) }}

{{ Form::label('mail adress') }}
{{ Form::email('mail',null,['class' => 'new_input']) }}

{{ Form::label('password') }}
{{ Form::password('password',null,['class' => 'new_input']) }}

{{ Form::label('password confirm') }}
{{ Form::password('password_confirmation',null,['class' => 'new_input']) }}

{{ Form::submit('REGISTER',['class'=>'register_button']) }}

<p><a href="/login">ログイン画面に戻る</a></p>



{!! Form::close() !!}

</div>
@endsection
