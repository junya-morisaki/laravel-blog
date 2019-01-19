@extends('layouts.layouts')

@section('title')
投稿
@endsection

@section('content')
<div class="container">
<div class="col-12">

<form class="" action="{{route('post')}}" method="post">
<input type="text" name="title" value="" placeholder="タイトル">
<select class="" name="category">
  <option value="">カテゴリを選択してください</option>
  <option value="健康">健康</option>
  <option value="テクノロジー">テクノロジー</option>
  <option value="恋愛">恋愛</option>
  <option value="音楽">音楽</option>
  <option value="アート">アート</option>
  <option value="料理">料理</option>
  <option value="ゲーム">ゲーム</option>
  <option value="スポーツ">スポーツ</option>
  <option value="社会">社会</option>
  <option value="その他">その他</option>
</select>
<br>

<textarea name="post" rows="8" cols="80"></textarea><br>
<input type="submit" name="" value="投稿">
{{csrf_field()}}
</form>

</div>
</div>
@endsection
