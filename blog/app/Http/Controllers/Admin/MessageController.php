<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
  public function edit($user_id){
    return view('admin.edit',[
      'user_id'=>$user_id
    ]);
  }

  public function store(Request $request,$user_id){
    $msg = new Message;
    $msg->user_id = $user_id;
    $msg->message = $request->message;
    $msg->save();

    return redirect('/admin/home');
  }
}
