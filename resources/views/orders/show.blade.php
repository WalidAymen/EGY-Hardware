@extends('layout')
@section('title')
    View Order Details
@endsection
@section('body')
    <div class="col-sm-9 padding-right ">
        <section id="cart_items">
            <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Order detailes</li>
                    </ol>
                </div>
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Image</td>
                                <td class="description">Name</td>
                                <td class="price">Price</td>
                                <td class="quantity">Count</td>
                                <td class="model">Model</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="cart_product">
                                            <a href="{{ url("/products/show/$product->id") }}"><img
                                                    style="width: 8rem; height: 8rem;"
                                                    src="{{ asset("uploads/$product->img") }}" alt=""></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href="{{ url("/products/show/$product->id") }}">{{ $product->name }}</a>
                                            </h4>
                                            <p>{{ $product->model }}</p>
                                        </td>
                                        <td class="cart_price">
                                            <p>{{ number_format($product->pivot->count * $product->price ,2) }} EGP</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <span style="padding: 1rem"
                                                class="h3 btn-outline-info ">{{ $product->pivot->count }}</span>
                                        </td>
                                        <td>
                                            <p style="padding: 1rem">{{ $product->model }}</p>
                                        </td>

                                        <td>
                                        </td>
                                    </tr>
                                @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            @if ($order->status=='shipped')
            <div class="container text-center">
                <a href="{{url("/returnorder/$order->id")}}">
                <button class="btn btn-danger">Request return</button>
                </a>
                <br><br><br>
            </div>
            @endif
        </section>
        <!--/#cart_items-->
        <section id="do_action my-5">
            <div class="container">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="total_area">
                            <ul>
                                <li>Total <span>{{ number_format($order->total_price ,2) }} EGP</span></li>
                                <li>Status <span>{{ $order->status }} </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/#do_action-->
    </div>
@endsection
