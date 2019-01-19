<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

  public function edit($post_id){
    return view('blog.comment',[
      'post_id' => $post_id,
    ]);
  }

    public function post(CommentRequest $request,$post_id){
      $comment = new Comment;
      $id = Auth::id();
      $comment->post_id = $post_id;
      $comment->comment =  $request->comment;
      $comment->user_id=$id;
      $comment->save();

      return redirect(route('post.content',['post_id' =>$post_id]))->with('flash_message','コメントを投稿しました');
    }
}
