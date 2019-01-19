@extends('layouts.layouts')

@section('title')
コメント
@endsection

@section('content')
<div class="container">
<div class="col-12">

<form class="" action="{{route('commentPost',['post_id'=>$post_id])}}" method="post">
<textarea name="comment" rows="8" cols="80"></textarea><br>
<input type="submit" name="" value="投稿">
{{csrf_field()}}
</form>

</div>
</div>
@endsection
