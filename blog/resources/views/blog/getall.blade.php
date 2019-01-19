@extends('layouts.layouts')

@section('title')
全投稿一覧
@endsection


@section('content')

@include('components.posts_list')

{{ $posts->links() }}
@endsection
