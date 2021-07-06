@extends('DashBoard.dashLayout')
@section('tittle')
    Edit User Informations
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
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="my-5">
                    @include('errorrs')
                </div>                <div class="table-title ">
                    <h2 class="text-light ">Update <b>User informations</b></h2>
                </div>
            </div>
        </div>
        <form class="mb-3 text-center" method="POST" action="{{ url("/admin/edituser/$user->id") }}">
            @csrf
            <input class="form-control  my-3" type="text" name="name" placeholder="User name" value="{{$user->name}}">
            <input class="form-control  my-3" type="text" name="email" placeholder="User email" value="{{$user->email}}">
            <input class="form-control  my-3" type="password" name="password" placeholder="New Password (*IF YOU WANT TO CHANGE IT*)" >
            <input class="form-control  my-3" type="text" name="phone" placeholder="User phone" value="{{$user->phone}}">
            <select class="form-control form-select  my-3" name="role">
                <option selected value="{{$user->role}}">{{$user->role}}</option>
                @if ($user->role != "customer")
                    <option value="customer">Customer</option>
                @endif
                @if ($user->role != "bookkeeper")
                    <option value="bookkeeper">bookkeeper</option>
                @endif
                @if ($user->role != "admin")
                    <option value="admin">admin</option>
                @endif
                @if ($user->role != "super_admin")
                    <option value="super_admin">super_admin</option>
                @endif
              </select>
              <select class="form-select my-3" aria-label="Default select example" name="city">
                @if ($user->city != null)
                <option selected>{{$user->city}}</option>
                @endif
                @foreach ($govs as $gov)
                    @if ($gov->name != $user->city)
                        <option>{{$gov->name}}</option>
                    @endif
                @endforeach
              </select>
            <input class="form-control  my-3" type="text" name="address" placeholder="User Address" value="{{$user->address}}">

            <input class="btn btn-success  my-3 form-control" type="submit" value="Update">
        </form>
    </div>
    </div>
    </div>
@endsection

