<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fav;
use App\Post;
use App\Comment;
use App\Follow;
use App\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow($user_id){
      $follow =new Follow;
      $id= Auth::id();
      $follow->user_id=$id;
      $follow->follow_id=$user_id;
      $follow->save();

      return redirect(route('user.prof',['user_id' =>$user_id]))->with('flash_message','フォローしました');
    }

    public function unfollow($user_id){
      $id = Auth::id();
      $follow = Follow::where('user_id', '=', $id)->where('follow_id','=',$user_id)->first();
      $follow->delete();

      return redirect(route('user.prof',['user_id' =>$user_id]))->with('flash_message','フォローを外しました');
    }

    public function show($user_id,$param){
      $array=[];

      if($param === 'follow'){
      $user = User::find($user_id);
      $follows = $user->follows;
      foreach($follows as $follow){
        $array[] = $follow->follow_id;
      }

     }elseif($param ==='follower'){
        $followers = Follow::where('follow_id','=',$user_id)->get();
        foreach($followers as $follower){
          $array[] = $follower->user_id;
        }
      }else{
        redirect('/');
      }

      $users = User::whereIn('id',$array)->paginate(10);

      return view('blog.follow_show',[
        'users' =>$users
      ]);
    }
}
