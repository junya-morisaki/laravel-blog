@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard(Admin)</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
            <h3>ユーザー一覧</h3>
            @foreach($users as $user)
            {{$user->id}}
            {{$user->name}}
            <a href="/admin/edit/{{$user->id}}">メッセージを送る</a>
            <br>
            @endforeach
        </div>
    </div>
</div>
@endsection
