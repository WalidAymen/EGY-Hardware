@extends('layout')
@section('title')
    Confirm Order
@endsection
@section('body')
    <div class="col-sm-9 padding-right ">
        <h2 class="title text-center">Your Products</h2>
        @foreach ($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center"  style="height: 40rem">
                            <a href="{{url("/products/show/$product->id")}}"  style="height: 35rem">
                                <img style="width: 100%; height: 15rem;" src="{{asset("uploads/$product->img")}}" alt="" />
                                <h2 style="height: 5rem" class="position-relative d-flex align-items-center justify-content-center">
                                @if ($product->sale_price!=null)
                                <p class="text-danger" style="height: 2rem;font-size: 2rem"><del>{{$product->price}} EGP</del></p>
                                <h2 style="height: 5rem">{{number_format($product->pivot->count * $product->sale_price)}} EGP</h2>
                                @else
                                <h2 style="height: 5rem">{{number_format($product->pivot->count * $product->price)}} EGP</h2>
                                @endif
                                </h2>
                                <h5 class="overflow-hidden" style="height: 5rem">{{$product->name}}</h5>
                            </a>
                        </div>
                    @if ($product->sale_price!=null)
                    <img src="{{ asset("images/home/sale.png")}}" class="new" alt="" />
                    @endif
                </div>
            </div>
        </div>
        @endforeach
            <div class="col-sm-12">
                <div class="total_area">
                    <ul>
                        <li>City <span>{{ $user->city }} </span></li>
                        <li>Address <span>{{$user->address}}</span></li>
                        <li>Phone <span>{{$user->phone}}</span></li>
                        <li>Order price <span>{{number_format($orderPrice)}} EGP</span></li>
                        <li>Shipping <span>{{number_format($shipping)}} EGP</span></li>
                        <li>Total price <span>{{number_format($totalPrice)}} EGP</span></li>
                    </ul>
                    <div class="text-center">
                    <a class="btn btn-success" href="{{url('/submitorder')}}">Confirm order</a>
                </div>
            </div>
            </div>
    </div>
@endsection
