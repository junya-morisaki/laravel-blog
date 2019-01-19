@extends('layouts.layouts')

@section('title')
{{$category}}の記事一覧
@endsection

@section('content')
<h1>{{$category}}の記事一覧</h1>
<br>
  @include('components.category_list')


<div class="container">
<div class="col-12">

  @include('components.posts_list')

</div>
</div>
{{$posts->links()}}
@endsection
