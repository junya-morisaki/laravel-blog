@extends('layouts.layouts')

@section('title')
投稿
@endsection

@section('content')

<div class="container">
 <div class="col-12">
  <div class="text-center">
    <img src="{{asset($post->user->icon_path)}}" alt="サムネイル" class="w-25 h-25 ">
    <br>
    <a href="{{route('user.prof',['user_id'=>$post->user->id])}}" class="text-center btn btn-secondary mb-1">投稿者：{{$user->name}}</a>
    <br>
    <a href="{{route('post.category',['category'=>$post->category])}}" class="text-center btn btn-secondary">カテゴリ:{{$post->category}}</a>
    <br>
    お気に入り数:{{$sum}}
  </div>
  <br>
  <h3 class="border border-secondary rounded d-block p-1">
    {{$post->title}}
  </h3>
  <br>
  <div class="border border-secondary rounded d-block pb-5 pt-2 px-1">
    {!! $content !!}
  </div>
  <br>
  @php
  $bool = isset($fav);
  @endphp


  @if(Auth::check())
   <div class="fav">
   @if($bool)
    <input class="btn btn-warning" type="submit" name="fav" value="お気に入り解除" id ='off'>
   @else
    <input class="btn btn-secondary" type="submit" name="fav" value="お気に入り" id ='on'>
   @endif
   </div>
  @endif

  <a class ="btn btn-primary" href="{{route('commentEdit',['post_id'=>$post->id])}}">コメントする</a>
  <hr>
  @foreach($comments as $comment)
  @php
  $c = nl2br($comment->comment);
  @endphp
  <div class="media">
  <img src="{{asset($comment->user->icon_path)}}" alt="icon" style="width:100px; height:auto; margin-right:20px;">
  <div class="media-body ">
    <h3>{{$comment->user->name}}<h3>
      <h6>{!! $c !!}</h6>
      <h6>{{$comment->created_at}}</h6>

      <br>
    </div>
  </div>
  <hr>
  @endforeach
  </div>
 </div>
</div>
<script  src="https://code.jquery.com/jquery-3.3.1.js" ></script>
<script type="text/javascript">
$('#on').on('click', function() {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{route('favon',[ 'post_id'=>$post->id ])}}",
    type: 'POST',
  })
  // Ajaxリクエストが成功した場合
  .done(function(data) {
    $('div.fav').children().remove();
    $('div.fav').append('<input class="btn btn-warning" type="submit" name="fav" value="お気に入り解除" id ="off">');
  })
  // Ajaxリクエストが失敗した場合
  .fail(function(data) {
    alert('失敗');
  });
});

$('#off').on('click', function() {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },

    url:"{{route('favoff',[ 'post_id'=>$post->id ])}}",
    type: 'POST',
    data:{'_method': 'DELETE'},
  })
  // Ajaxリクエストが成功した場合
  .done(function(data) {
    $('div.fav').children().remove();
    $('div.fav').append('<input class="btn btn-secondary" type="submit" name="fav" value="お気に入り" id ="on">');
    })
  // Ajaxリクエストが失敗した場合
  .fail(function(data) {
    alert('失敗');
  });
});


</script>
@endsection
