<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>メッセージ編集</title>
  </head>
  <body>
    <form class="" action="/admin/edit/{{$user_id}}" method="post">
      {{csrf_field()}}
      <textarea name="message" rows="8" cols="80"></textarea>
      <br>
      <input type="submit" name="" value="送信">
    </form>
  </body>
</html>
