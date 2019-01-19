@extends('layouts.layouts')

@section('title')
ブログトップ
@endsection

@section('content')
  @include('components.category_list')

<div class="container">
 <div class="col-12">


<h3>最新の投稿</h3>
@php
$posts = $new_posts;
@endphp

@include('components.posts_list')


<h3>人気の投稿</h3>

@foreach($fav_posts as $post)
<a href="{{route('post.content',['post_id' => $post->id])}}">
  <div class="media border border-secondary rounded p-2">
    <div class="media-body">
      <h3>{{$post->title}}</h3>
      <h6>投稿者:{{$post->name}}</h6>
      <h6 class="">カテゴリ:{{$post->category}}  投稿日時:{{$post->created_at}} </h6>
    </div>
</div>
</a>
<br>
@endforeach

 </div>
</div>

@endsection
