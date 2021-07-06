@extends('layout')
@section('title')
{{$tittle}}
@endsection
@section('slider')
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>EGY</span>-Hardware</h1>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset("images/home/1.jpg") }}" class=" img-responsive" alt="" />
                                <img src="{{ asset("images/home/pricing.png") }}"  class="pricing" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>EGY</span>-Hardware</h1>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset("images/home/2.jpg") }}" class=" img-responsive" alt="" />
                                <img src="{{ asset("images/home/pricing.png") }}"  class="pricing" alt="" />
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>EGY</span>-Hardware</h1>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset("images/home/3.jpg") }}" class=" img-responsive" alt="" />
                                <img src="{{ asset("images/home/pricing.png") }}" class="pricing" alt="" />
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

@endsection
@section('body')
<div class="col-sm-9 padding-right ">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Products</h2>
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
                                <h2 style="height: 5rem">{{number_format($product->sale_price)}} EGP</h2>
                                @else
                                <h2 style="height: 5rem">{{number_format($product->price)}} EGP</h2>
                                @endif
                                </h2>
                                <h5 class="overflow-hidden" style="height: 5rem">{{$product->name}}</h5>
                            </a>
                            <a href="{{url("/addtocart/$product->id")}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    @if ($product->sale_price!=null)
                    <img src="{{ asset("images/home/sale.png")}}" class="new" alt="" />
                    @endif
                    @if ($product->stock!='in Stock')
                    <img src="{{ asset("images/home/out-of-stock.png")}}" class="outStock" alt="" />
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection
@section('paginate')
<div class="text-center">{{ $products->links() }}</div>

@endsection
