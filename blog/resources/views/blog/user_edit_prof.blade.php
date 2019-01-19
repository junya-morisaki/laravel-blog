@extends('layouts.layouts')

@section('title')
プロフィール編集
@endsection

@section('content')
<h2>プロフィール編集</h2>
<form class="" action="" method="post">
  <textarea name="profile" rows="8" cols="80">{{$user->profile}}</textarea>
  {{csrf_field()}}
  <input type="submit" name="" value="更新">
</form>
@endsection
