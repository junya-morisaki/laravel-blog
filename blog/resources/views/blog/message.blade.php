@extends('layouts.layouts')

@section('title')
通知
@endsection

@section('content')
<div class="container">
 <div class="col-12">

  @foreach($messages as $message)
   <div class="media border border-secondary rounded p-2 mb-2">
    <div class="media-body">
    {{$message->message}}
    <br>
   </div>
  </div>
  @endforeach
 </div>
</div>
@endsection
