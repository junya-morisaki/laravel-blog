@extends('layouts.layouts')

@section('title')
ランキング
@endsection
@section('content')
@if($span ==='day')
<h2>24時間<h2>
@elseif($span ==='month')
<h2>月間</h2>
@endif
<a href="{{route('fav.rank',['span'=>'day'])}}" class="btn btn-primary">24時間</a>
<a href="{{route('fav.rank',['span'=>'month'])}}" class="btn btn-primary">月間</a>
<div class="container">
<div class="col-12">


  @foreach($posts as $post)
  <a href="{{route('post.content',['post_id' => $post->id])}}">
    <div class="media border border-secondary rounded p-2">
      <div class="media-body">
        <h3>{{$post->title}}</h3>
        <h6>投稿者:{{$post->name}}</h6>
        <h6 class="">カテゴリ:{{$post->category}}  投稿日時:{{$post->created_at}} お気に入り数:{{$post->sum}}</h6>
      </div>
    </a>
  </div>
  <br>
  @endforeach
</div>
</div>
@endsection
