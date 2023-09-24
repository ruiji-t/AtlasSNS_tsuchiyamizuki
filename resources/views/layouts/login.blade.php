<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header >
        <div class="header_container">
            <div class="atlas_icon">
                <a href="/top"><img src="{{ asset('images/atlas.png') }}"></a>
            </div>
            <!-- ログインユーザー名 -->
            <div class="user_name">
                <p>{{ Auth::user()->username }}  さん</p>
            </div>
            <!-- アコーディオンメニュー -->
            <div class="menu_button">
                <span class="arrow"></span>
            </div>
            <nav class="accordion_menu">
                <ul>
                    <li class="accordion_list"><a href="/top">HOME</a></li>
                    <li class="accordion_list"><a href="/users/{{ Auth::user()->id }}/profile">プロフィール編集</a></li>
                    <li class="accordion_list"><a href="/logout">ログアウト</a></li>
                </ul>
            </nav>
            <!-- ユーザーアイコン -->
            <div class="user_icon">
                <img src="{{ asset('storage/'.Auth::user()->images) }}">
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >

        <!-- サイドバー -->
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }}  さんの</p>
                <div class="follow_box">
                <p>フォロー数</p>
                <p>{{ Auth::user()->follows()->count() }} 名</p>
                </div>
                <button class="follow_btn" type="button"><a href="/follow-list">フォローリスト</a></button>
                <div class="follower_box">
                <p>フォロワー数</p>
                <p>{{ Auth::user()->followers()->count() }} 名</p>
                </div>
                <button class="follower_btn" type="button"><a href="/follower-list">フォロワーリスト</a></button>
            </div>
            <button class="search_btn" type="button"><a href="/search">ユーザー検索</a></button>
        </div>
    </div>
    <footer>
    </footer>
    <script src="{{ asset('https://code.jquery.com/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
