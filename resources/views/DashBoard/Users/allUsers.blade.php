@extends('DashBoard.dashLayout')
@section('tittle')
    Manage All Users
@endsection
@section('user')
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
        .w-20{
            width: 20%;
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
                    <h2 class="text-light ">Manage <b>Users</b></h2>
                </div>
                <form class="d-flex justify-content-center" action="{{url("/admin/usersearch")}}" method="GET">
                    <input class="form-control w-50 mx-3" type="text" name="keyword" placeholder="Search keyword"  @if (isset($keyword)) value="{{$keyword}}" @endif>
                    <input class="form-control w-25 btn btn-info mx-3" type="submit" value="Search">
                </form>
            </div>
        </div>
        <form class="mb-3 text-center d-flex" method="POST" action="{{ url('/admin/adduser') }}">
            @csrf
            <input class="form-control w-25 m-1 p-1" type="text" name="name" placeholder="User name">
            <input class="form-control w-25 m-1 p-1" type="text" name="email" placeholder="User email">
            <input class="form-control w-25 m-1 p-1" type="password" name="password" placeholder="Password">
            <input class="form-control w-25 m-1 p-1" type="text" name="phone" placeholder="User phone">
            <select class="form-control form-select w-25 m-1 p-1" name="role">
                <option value="customer">Customer</option>
                <option value="bookkeeper">Bookkeeper</option>
                <option value="admin">Admin</option>
                <option value="super_admin">Super Admin</option>
              </select>
            <input class="btn btn-success w-25 m-1 p-1 form-control" type="submit" value="Add">
        </form>
        <table class="table table-striped table-hover border text-center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)

                    <tr>
                        <td class="w-20">
                            {{ $user->name }}
                        </td>
                        <td class="w-20">
                            {{ $user->email }}
                        </td>
                        <td class="w-20">
                            {{ $user->phone }}
                        </td>
                        <td class="w-20">
                            {{ $user->role }}
                        </td>
                        <td class="w-20">
                            <a href="{{ url("admin/edituser/$user->id") }}"><i
                                class="fas fa-edit text-warning"></i></a>
                            <a href="{{ url("admin/deleteuser/$user->id") }}" class="delete"><i
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

