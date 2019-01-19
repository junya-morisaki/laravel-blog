<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfRequest;
use App\Post;
use App\Comment;
use App\Fav;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
  public function show($user_id){
    $user=User::find($user_id);
    $id=Auth::id();
    $follow = Follow::where('user_id','=',$id)->where('follow_id', '=', $user_id)->first();
    $notme =  ($user->id !== $id);

    $follow_sum = Follow::where('user_id','=',$user->id)->count();
    $follower_sum = Follow::where('follow_id','=',$user->id)->count();



    return view('blog.user_profile',[
      'user'         => $user,
      'follow'       => $follow,
      'notme'        => $notme,
      'follow_sum'   => $follow_sum,
      'follower_sum' => $follower_sum,

    ]);

  }

  public function editImage(){
    $id=Auth::id();
    $user =user::find($id);
    return view('blog.user_edit_icon',[
      'user'=>$user
    ]);
  }

  public function postImage(Request $request){
    $id=Auth::id();
    $user = User::find($id);
    //拡張子の判定
    // ファイル拡張子を抜き出す

$file_ext = pathinfo($_FILES["icon"]['name'], PATHINFO_EXTENSION);


// 大文字を小文字にする
$file_ext = strtolower($file_ext);


// 拡張子を照合する

if($file_ext != "jpg" && $file_ext != "gif" && $file_ext != "png"){
//フラッシュメッセージ,バリデーションにする
  return redirect(route('user.editImage'));
}
    $type=$file_ext;
    //ユーザーＩｄに紐づいた命名
    $name="icon_userid_{$id}.{$type}";
    $path ='/storage/'.Storage::putFileAs('icon',$request->file('icon'),$name);
    $user->icon_path=$path;
    $user->save();
    //pathをＤＢへ保存

     return redirect(route('user.prof',['user_id' => $id]))->with('flash_message', '画像を変更しました');;
  }

  public function editProf(){

    $user =Auth::user();
    return view('blog.user_edit_prof',[
      'user'=>$user
    ]);
  }

  public function postProf(ProfRequest $request){
    $user=Auth::user();
    $user->profile=$request->profile;
    $user->save();

    return redirect(route('user.prof',['user_id' => $user->id]))->with('flash_message', 'プロフィールを変更しました');
;
  }

  public function showPost($user_id){
    $user = User::find($user_id);
    $posts = Post::where('user_id','=',$user_id)->orderby('created_at','desc')->paginate(10);

    return view('blog.posts_list',[
      'user'  => $user,
      'posts' => $posts,
      'title' => $user->name.'さんの投稿一覧' 
    ]);
  }
}
