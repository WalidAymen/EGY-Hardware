@extends('layout')
@section('title')
    Your Orders
@endsection
@section('body')

    <div class="col-sm-9 padding-right ">
        <h2>Your Orders</h2>
        @if (count($orders)>0)
            @foreach ($orders as $order)


            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        <p>
                        </p>
                        <div class="order-list">
                            <div class="order-id"><b>Order ID:</b># {{$order->id}}</div>
                            <div class="order-status"><b>Status:</b> {{$order->status}}</div>
                            <div class="order-content">
                                <div>
                                    <b>Date Added:</b> {{date_format($order->created_at,"Y/m/d")}}<br>
                                    <b>Time Added:</b> {{date_format($order->created_at,"h:i A")}}<br>
                                    <b>Products</b> {{count($order->products)}}
                                </div>
                                <div><b>Customer:</b> {{$order->user->name}}<br>
                                    <b>Total:</b> {{number_format($order->total_price,2)}} EGP
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <p><a href="{{url("/showorder/$order->id")}}"
                                class="btn btn-warning" role="button">View Order</a>

                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
@endsection

