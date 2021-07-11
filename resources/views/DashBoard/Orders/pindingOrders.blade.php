@extends('DashBoard.dashLayout')
@section('tittle')
    Manage Pending Orders
@endsection
@section('pinding')
    active
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
            <h2 class="text-light ">Pinding <b>Orders</b></h2>
        </div>
        <div class="row">
            @foreach ($orders as $order)
                <div class="col-sm-3">
                    <div class="card ">
                        <a href="{{ url("/admin/deleteorder/$order->id") }}" class="close"></a>
                        <div class="card-body">
                            <div class="order-id"><b>Order ID:</b># {{ $order->id }}</div>
                            <div id="case2" class="order-status"><b>Status:</b> {{ $order->status }}</div>
                            <form class="form-inline" action="{{ url("/admin/updateorder/$order->id") }}"  method="POST" style="display: none" id="case1">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-8 ">
                                <select class="form-select" name="status">
                                    <option selected value="{{$order->status}}">{{$order->status}}</option>
                                    @if ($order->status != "pending")
                                        <option value="pending">pending</option>
                                    @endif
                                    @if ($order->status != "canceled")
                                        <option value="canceled">canceled</option>
                                    @endif
                                    @if ($order->status != "completed")
                                        <option value="completed">completed</option>
                                    @endif
                                    @if ($order->status != "shipped")
                                        <option value="shipped">shipped</option>
                                    @endif
                                    @if ($order->status != "declined")
                                        <option value="declined">declined</option>
                                    @endif
                                    @if ($order->status != "request return")
                                        <option value="request return">request return</option>
                                    @endif
                                  </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="submit" class="btn btn-warning  " value="update">
                                </div>
                                </div>
                            </form>
                            <div class="order-content">
                                <div>
                                    <b>Date Added:</b> {{ date_format($order->created_at, 'Y/m/d') }}<br>
                                    <b>Time Added:</b> {{ date_format($order->created_at, 'h:i A') }}<br>
                                    <b>Products</b> {{ count($order->products) }}
                                </div>
                                <div><b>Customer:</b> {{ $order->user->name }}<br>
                                    <b>Total:</b> {{ number_format($order->total_price) }} EGP
                                </div>
                            </div>
                            <a href="{{ url("/admin/showorder/$order->id") }}">
                                <button class="btn btn-warning mt-3">View order details</button>
                            </a>
                            <button id="toggle" class="btn btn-primary my-3">Change order status</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $("div #toggle").click(function(){
      $(this).siblings("#case1").toggle();
      $(this).siblings("#case2").toggle();
    });
  });
  </script>
@endsection
