<!DOCTYPE html>
<html lang="ja" >
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="css/styles.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
  </head>
  <body>

      <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-3">
        <div class="navbar-nav">
            <a class ="nav-brand btn btn-primary" href="/" >AmenbaBlog</a>
            <a class ="nav-link" href="/" >トップ</a>
              <a class ="nav-link" href="{{route('fav.rank',['span'=>'day'])}}" >人気の投稿</a>
            @if(Auth::check())
            <a class ="nav-link" href="{{route('post.timeline')}}" >タイムライン</a>
            <a class ="nav-link" href="{{route('user.prof',['user_id' => Auth::id()])}}">マイページ</a>
            <a class ="nav-link" href="{{route('post.edit')}}" >投稿</a>
            <a class ="nav-link" href="{{route('message')}}" >通知</a>
            <form action="{{ route('logout') }}" method="POST" class="justify-content-end">
                {{ csrf_field() }}
                <input class="btn mr-3" type="submit" name="" value="ログアウト">
            </form>
            <form class="form-inline" action="{{route('post.search')}}" method="get">
              <input class="form-control mr-sm-2" type="search" name="key" placeholer="検索キーワード">
              <button class="btn my-2 my-sm-0 justify-content-end" type="submit" >検索</button>
            </form>
            @else
            <a class ="nav-link" href="{{route('register')}}" >新規登録</a>
            <a class ="nav-link" href="{{route('login')}}" >ログイン</a>
            @endif
        </div>
      </nav>
      @php
      $s=session('flash_message');
      @endphp

      @isset($s)
      <div class="text-center alert alert-success ">
        {{ session('flash_message') }}
      </div>
      @endisset
      @if($errors->any())
    <div class="text-center alert alert-danger">
      @foreach($errors->all() as $error)
      {{$error}}
      <br>
      @endforeach
    </div>
      @endif
      @yield('content')
      <script  src="https://code.jquery.com/jquery-3.3.1.js" ></script>
  </body>
</html>
