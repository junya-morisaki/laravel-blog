<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fav;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class FavController extends Controller
{
    public function on($post_id){

      $fav = new Fav;
      $user_id = Auth::id();
      $fav->user_id=$user_id;
      $fav->post_id=$post_id;
      $fav->save();

      
    }

    public function off($post_id){
      $id = Auth::id();
      $fav = Fav::where('user_id','=',$id)->where('post_id', '=', $post_id)->first();
      $fav->delete();


    }

    public function show(){
      $id=Auth::id();
      $favs = Fav::where('user_id','=',$id)->get();
      $array=[];
      foreach($favs as $fav){
        $array[]=$fav->post_id;
      }
      $posts = Post::whereIn('id',$array)->paginate(10);

      return view('blog.posts_list',[
        'posts'=>$posts,
        'title'=>'お気に入り'
      ]);
    }

    public function rank($span){

      if($span === 'day'){
        $num=1;
      }elseif($span === 'month'){
        $num=30;
      }else{
        return redirect('/');
      }

      $time = new \DateTime("-{$num} day");

      //数の上限設定,期間とカテゴリ選択
      $sql='select posts.*,users.name, count(*) as sum from favs left join posts on posts.id=favs.post_id left join users on posts.user_id= users.id where favs.created_at > :time group by posts.id order by sum desc ';
      $posts = DB::select($sql,[
        'time' =>  $time->format('Y-m-d H:i:s')
      ]);

      return view('blog.fav_rank',[
        'posts' => $posts,
        'span'  => $span
      ]);
    }

}
