@extends('layouts.layouts')

@section('title')
{{$title}}
@endsection

@section('content')
<div class="container">
<div class="col-12">

  <h1>{{$title}}</h1>
  @include('components.posts_list')
  <h5>{{$posts->links()}}<h5>
</div>
</div>
@endsection
