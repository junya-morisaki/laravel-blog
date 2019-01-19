@extends('layouts.layouts')

@section('title')
プロフィール
@endsection

@section('content')
    <div class="container ">
      <div class="col-12 text-center" >
        <h2>{{$user->name}}さんのプロフィール</h2>
    <!-- サイズ調節 -->
    <img src="{{asset($user->icon_path)}}" alt="icon" class="w-25 h-25 mb-2">
    <br>
    @if(Auth::check() && $user->id === Auth::id())
    <a class="btn btn-secondary my-2" href="{{route('user.editImage')}}">画像を編集する</a>
    <a class="btn btn-warning my-2" href="{{route('fav.show')}}">お気に入りを見る</a>
    @endif
    <br>
フォロー:<a href="{{route('follow.show',['user_id' => $user->id ,'param' => 'follow'])}}">{{$follow_sum}}</a>
  フォロワー:<a href="{{route('follow.show',['user_id'=> $user->id ,'param' => 'follower'])}}">{{$follower_sum}}</a>


    <!-- 条件分岐かく -->
    @php
    $bool = isset($follow);
    @endphp

    @if($notme)
    @if($bool)
    <form class="" action="{{route('unfollow',['user_id'=>$user->id])}}" method="post">
      {{csrf_field()}}
      <input class="btn btn-primary" type="submit" name="" value="フォロー解除">
    </form>
    @else

    <form class="" action="{{route('follow',['user_id'=>$user->id])}}" method="post">
      {{csrf_field()}}
      <input class="btn btn-primary" type="submit" name="" value="フォロー">
    </form>
    @endif
    @endif


    <div class="border border-secondary rounded d-block pb-5 pt-2 px-1">
      @php
      echo nl2br($user->profile);
      @endphp
  </div>
    @if(Auth::check() && $user->id === Auth::id())
      <a class="btn btn-secondary my-2" href="{{route('user.editProf')}}">プロフィールを編集する</a>
    @endif
    <br>

    <a class="btn btn-primary my-2" href="{{route('user.posts',['user_id' => $user->id])}}">投稿を見る</a>

  </div>
</div>
<br>
@endsection
