@extends('layouts.logout')


@section('content')
<header>
    <div class="login_title">
      <h1>
        <a href="/top">
          <img src="{{asset('images/atlas.png')}}">
        </a>
      </h1>
      <p>Social Network Service</p>
    </div>
</header>

<div id="login_container">
<!-- 適切なURLを入力してください -->

{!! Form::open(['url' => '/login']) !!}

<p>AtlasSNSへようこそ</p>

{{ Form::label('mail adress') }}
{{ Form::email('mail',null,['class' => 'input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::submit('LOGIN',['class'=>'login_button']) }}

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}
</div>
@endsection
