@extends('layouts.layouts')

@section('title')
フォロー一覧
@endsection

@section('content')
<div class="container">
  <div class="col-12">

  @foreach($users as $user)
    <div class="media">
      <img src="{{$user->icon_path}}" style="width:50px; height:auto; margin-right:20px;">
      <div class="media-body">
      <a href="{{route('user.prof',['user_id' => $user->id])}}">{{$user->name}}</a>
     </div>
   </div>
   <hr>
   @endforeach
   <h5>{{$users->links()}}<h5>
  </div>
</div>
@endsection
