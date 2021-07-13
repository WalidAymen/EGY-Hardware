@extends('DashBoard.dashLayout')
@section('tittle')
    Manage Return Requests
@endsection
@section('allorders')
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
        <div class="table-title">
            <h2 class="text-light ">Show <b>Order #{{$order->id}} Details</b></h2>
        </div>
        <div class="w-100 text-center mt-5 mb-4" style="min-height: 25vh">
            <h3><b>Order total price</b> : {{number_format($order->total_price ,2)}}</h3>
            <h3><b>Order status</b> : {{($order->status)}}</h3>
            <h3><b>Customer name</b> : {{$order->user->name}}</h3>
            <h3><b>Customer phone</b> : {{$order->user->phone}}</h3>
            <h3><b>Customer mail</b> : {{$order->user->email}}</h3>
            <h3><b>Customer city</b> : {{$order->user->city}}</h3>
            <h3><b>Customer address</b> : {{$order->user->address}}</h3>
            <br>
            <br>
            <br>
            <h1 class="text-primary"><b>Products</b> :</h1>
        </div>
        <div class="row">
            @foreach ($products as $product)
                @for ($i = 0; $i < $product->pivot->count; $i++)
                    <div class="col-sm-4">
                        <div class="card ">
                            @if ($order->status == 'pending')
                                <a href="{{ url('/admin/dropfromorder/' . $order->id . '/' . $product->id) }}"
                                    class="close"></a>
                            @endif
                            <div class="card-body">
                                <div class="order-id"><b>Product name:</b> {{ $product->name }}</div>
                                @if ($product->sale_price != null)
                                    <div id="case2" class="order-status"><b>Price:</b> {{ number_format($product->sale_price ,2) }}</div>
                                @else
                                    <div id="case2" class="order-status"><b>Price:</b> {{ number_format($product->price ,2) }}</div>
                                @endif
                                <div id="case2" class="order-status text-center my-3">
                                    <img class="img-fluid" style="width: 20rem;height: 20rem;"
                                        src="{{ asset("uploads/$product->img") }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor

            @endforeach
        </div>
    </div>
@endsection
