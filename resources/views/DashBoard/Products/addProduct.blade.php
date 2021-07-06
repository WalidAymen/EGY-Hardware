@extends('DashBoard.dashLayout')
@section('tittle')
    Add New Product
@endsection
@section('addproduct')
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

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px
        }

        .alert-danger {
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
        }

        .alert-danger .alert-link {
            color: #6a1a21;
        }

    </style>
@endsection
@section('body')
    <div class="container">
        <div class="my-5">
            @include('errorrs')
        </div>
        <div class="table-title ">
            <h2 class="text-light ">Add <b>Product</b></h2>
        </div>
        <div class="my-5">
            <form action="{{ url('/admin/addproduct') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label class="h4 form-label">Product Name:</label>
                <input class="form-control" type="text" name="name" placeholder="Name">

                <label class="h4 form-label my-3">Product Price:</label>
                <input class="form-control" type="number" name="price" placeholder="Price">

                <label class="h4 form-label my-3">Product Sale Price (optinal) :</label>
                <input class="form-control" type="number" name="sale_price" placeholder="Sale Price">

                <label class="h4 form-label my-3">Product Brand:</label>
                <select class="form-control form-select" name="brand">
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>

                <label class="h4 form-label my-3">Product Category:</label>
                <select class="form-control form-select" name="category">
                    @foreach ($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <label class="h4 form-label my-3">Product Model (optinal) :</label>
                <input class="form-control" type="text" name="model" placeholder="Model">

                <div class="text-left my-3">
                    <label class=" h4 form-label form-check-label">
                        In Stock :
                    </label>
                    <input type="checkbox" name="stock" checked>
                </div>
                <label class="h4 form-label my-3">Product Image:</label>
                <input type="file" name="image" class="form-control">

                <label class="h4 form-label my-3">Product Discreption (optinal) :</label>
                <textarea class="form-control" name="discreption" placeholder="Discreption"></textarea>

                <input class="btn btn-info my-3" type="submit" value="Add product">
            </form>
        </div>
    </div>
@endsection
