@extends('DashBoard.dashLayout')
@section('tittle')
    Show All Messages
@endsection
@section('css')
    <style>
        .table-title {
            padding-bottom: 15px;
            background: #435d7d;
            color: #fff;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
        .close {
            position: absolute;
            right: 3%;
            top: 3%;
            width: 32px;
            height: 32px;
            opacity: 0.3;
        }

        .close:hover {
            opacity: 1;
        }

        .close:before,
        .close:after {
            position: absolute;
            left: 15px;
            content: ' ';
            height: 33px;
            width: 2px;
            background-color: rgb(150, 26, 26);
        }

        .close:before {
            transform: rotate(45deg);
        }

        .close:after {
            transform: rotate(-45deg);
        }

    </style>
@endsection
@section('body')
    <div class="container">
        <div class="table-title ">
            <h2 class="text-light ">All <b>Messages</b></h2>
        </div>
        <div class="row">
            @foreach ($messages as $message)
                <div class="col-sm-4">
                    <div class="card overflow-auto rounded shadow-lg with-3d-shadow" style="height: 15rem;">
                        <a href="{{ url("/admin/deletemessage/$message->id") }}" class="close"></a>

                        <div class="card-header">
                            <h5 class="card-title mb-1">User name: {{$message->user->name}}</h5>
                            <h5 class="card-title mb-1">User email: {{$message->user->email}}</h5>
                            <h5 class="card-title mb-1">User phone: {{$message->user->phone}}</h5>
                        </div>
                        <hr class="h2">
                        <div class="card-body">
                            @if (isset($message->tittle))
                            <h5 class="card-title text-center mb-2">Message tittle: {{$message->tittle}}</h5>
                            @endif
                            <p class="card-text">{{$message->body}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
