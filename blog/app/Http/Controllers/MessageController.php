<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;

class MessageController extends Controller
{
    public function show(){
      $messages = Message::where('user_id','=',Auth::id())->orderBy('created_at','desc')->paginate(10);

      return view('blog.message',[
        'messages' => $messages
      ]);
    }
}
