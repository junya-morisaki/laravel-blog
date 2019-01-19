@foreach($posts as $post)
<a href="{{route('post.content',['post_id'=>$post->id])}}">
  <div class="media border border-secondary rounded p-2">
    <div class="media-body">
      <h3>{{$post->title}}</h3>
      <h6>投稿者:{{$post->user->name}}</h6>
      <h6 class="">カテゴリ:{{$post->category}}  投稿日時:{{$post->created_at}}</h6>
    </div>
</div>
</a>
<br>
@endforeach
