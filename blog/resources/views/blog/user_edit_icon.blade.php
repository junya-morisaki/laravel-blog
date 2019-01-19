@extends('layouts.layouts')

@section('title')
プロフィール編集
@endsection

@section('content')
<div class="custom-file">
  <form class="" action="" method="post" enctype="multipart/form-data">
    <input class="custom-file-input" id="customFile=" lang='ja' type="file" name="icon" >
    <label class="custom-file-label" for="customFile">画像ファイル選択...</label>
    {{csrf_field()}}
    <input type="submit" name="" value="送信">
  </form>
</div>
@endsection
