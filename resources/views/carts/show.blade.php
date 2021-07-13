@extends('layout')
@section('title')
    Cart
@endsection
@section('body')
    <div class="col-sm-9 padding-right ">
        @if (count($products)>0)
        <section id="cart_items">
            <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Shopping Cart</li>
                    </ol>
                </div>
                <a href="{{url("/clearcart")}}"><button class="btn btn-danger">Clear cart?</button></a>

                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Item</td>
                                <td class="description"></td>
                                <td class="price">Price</td>
                                <td class="quantity">Count</td>
                                <td class="total">Add/Remove</td>
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
                                            <p>{{ number_format($product->pivot->count * $product->price , 2) }} EGP</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <span style="padding: 1rem"
                                                class="h3 btn-outline-info ">{{ $product->pivot->count }}</span>
                                        </td>
                                        <td>
                                            <a class="btn" href="{{ url("/addtocart/$product->id") }}"><i
                                                    class="h3 fas  fa-plus-square"></i></a>
                                            <a class="btn" href="{{ url("/deletefromcart/$product->id") }}"><i
                                                    class="h3 text-danger fas fa-minus-square"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!--/#cart_items-->
        <section id="do_action">
            <div class="container">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="total_area">
                            <ul>
                                <li>Cart Sub Total <span>{{ number_format($totalPrice , 2) }} EGP</span></li>
                                <li>Shipping Cost <span>According to the address</span></li>
                                <li>Total <span>{{ number_format($totalPrice ,2) }} EGP</span></li>
                            </ul>
                            <a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @else
        <div class="col-md-12 text-success m-5 p-5">
        <h1>Your cart is empty</h1>
        <a href="{{ url("/index") }}">
            <button class="btn btn-primary">Back to products?</button>
        </a>
    </div>
            @endif

        <!--/#do_action-->
    </div>
@endsection
