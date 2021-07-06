@extends('DashBoard.dashLayout')
@section('tittle')
    Manage All Brands
@endsection
@section('brand')
    active
@endsection
@section('css')
    <style>
        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

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

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
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
        <div class="table-responsive">
            <div class="table-wrapper">

                <div class="table-title ">
                    <h2 class="text-light ">Manage <b>Brands</b></h2>
                </div>
                <form class="d-flex justify-content-center" action="{{ url('/admin/brandsearch') }}" method="GET">
                    <input class="form-control w-50 mx-3" type="text" name="keyword" placeholder="Search keyword">

                    <input class="form-control w-25 btn btn-info mx-3" type="submit" value="Search">
                </form>
            </div>
        </div>
        <form class="mb-3 d-flex justify-content-between" method="POST" action="{{ url('/admin/addbrand') }}">
            @csrf
            <input class="form-control w-50" type="text" name="name" placeholder="Brand name">
            <input class="btn btn-success w-25" type="submit" value="Add">
        </form>
        <table class="table table-striped table-hover border text-center">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)

                    <tr>
                        <td class="w-75">
                            <div id="case1"> {{ $brand->name }} </div>
                            <form method="POST" id="case2" style="display: none"
                                action="{{ url("/admin/editbrand/$brand->id") }}">
                                @csrf
                                <input class=" w-25" type="text" name="name" placeholder="Brand new name"
                                    value="{{ $brand->name }}">
                                <input class="btn btn-success " type="submit" value="Update">
                            </form>
                        </td>
                        <td class="w-25">
                            <i id="toggle" class="fas fa-edit text-warning" style="cursor: pointer"></i>
                            <a href="{{ url("admin/deletebrand/$brand->id") }}" class="delete"><i
                                    class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("td #toggle").click(function() {
                $(this).parent().siblings("td").children("#case1").toggle();
                $(this).parent().siblings("td").children("#case2").toggle();
            });
        });
    </script>

@endsection
