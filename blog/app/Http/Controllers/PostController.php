<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Comment;
use App\Fav;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function index(){
      $new_posts = Post::orderBy('created_at','desc')->limit(3)->get();

      $time = new \DateTime("-1 day");

      //数の上限設定,期間とカテゴリ選択
      $sql='select posts.*,users.name, count(*) as sum from favs left join posts on posts.id=favs.post_id left join users on posts.user_id= users.id where favs.created_at > :time group by posts.id order by sum desc limit 3';
      $fav_posts = DB::select($sql,[
        'time' =>  $time->format('Y-m-d H:i:s')
      ]);

      return view('blog.index',[
        'new_posts' => $new_posts,
        'fav_posts' => $fav_posts
      ]);
    }

    public function post(PostRequest $request){
      //バリデーション
      $post =new Post;
      $id = Auth::id();
      $post->title = $request->title;
      $post->post = $request->post;
      $post->user_id = $id;
      $post->category = $request->category;
      $post->save();

      return redirect('/')->with('flash_message','記事を投稿しました');
    }

    public function edit(){
      return view('blog.edit');
    }

    public function getall(){
      $posts = Post::orderBy('created_at','desc')->paginate(10);

      return view('blog.posts_list', [
        'posts' => $posts,
        'title' => '新着の投稿'
      ]);
    }

    public function getone($post_id){
      $post = Post::find($post_id);
      $user =  $post->user;
      $content= nl2br($post->post);//改行文字変換
      $id = Auth::id();
      //コメント取得,一定数まで表示するようにする
      $comments = Comment::where('post_id', '=', $post_id)->orderBy('created_at')->get();

      $fav = Fav::where('user_id','=',$id)->where('post_id', '=', $post_id)->first();

      $sql='select count(*) as sum from favs left join posts on posts.id=favs.post_id where posts.id=:id group by posts.id ';
      $s = DB::select($sql,['id' => $post_id]);
      if(isset( $s[0]->sum)){
      $sum = $s[0]->sum;
    }else{
      $sum=0;
    }

      return view('blog.getone', [
        'post'   => $post,
        'user'   => $user,
      'content'  => $content,
      'comments' => $comments,
      'fav'      => $fav,
      'sum'      => $sum,
    ]);
    }

    public function commentEdit($post_id){
      return view('blog.comment',[
        'post_id' => $post_id,
      ]);
    }

      public function commentPost(Request $request,$post_id){
        $comment = new Comment;
        $id = Auth::id();
        $comment->post_id = $post_id;
        $comment->comment =  $request->comment;
        $comment->user_id = $id;
        $comment->save();

        return redirect(route('post.content',['post_id' => $post_id]));
      }

      public function timeline(){
        $user = Auth::user();
        $follows = $user->follows;
        $array =[];
        foreach($follows as $follow){
          $array[]=$follow->follow_id;
        }

        $posts = Post::whereIn('user_id',$array)->orderBy('created_at','desc')->paginate(10);

        return view('blog.posts_list',[
          'posts'=>$posts,
          'title'=>'タイムライン'
        ]);

      }

      public function category($category){

        $posts = Post::where('category','=',$category)->paginate(10);

        return view('blog.category',[
          'posts' => $posts,
          'category' =>$category
        ]);
      }

    

      public function search(Request $request){
        $key = $request->input('key');
        $posts = Post::where('post','like',"%{$key}%")->orderBy('created_at','desc')->paginate(10);

        return view('blog.posts_list',[
          'posts' => $posts,
          'title' => $key.'の検索結果'
        ]);
      }

}
