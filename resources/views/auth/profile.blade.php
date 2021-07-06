@extends('layout')
@section('title')
    {{$user->name}}
@endsection
@section('body')





<div class="col-md-5 text-">
    <div class="page-title-base">
        <h1 class="title-base">My Account</h1>
    </div>
    <br>
    <div class="links-list">
        <ul style="list-style: none; ">
            <li ><i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;&nbsp;<a
                    href="{{url('/editinfo')}}">Edit your account
                    informations</a></li><br>
            <li><i class="fa fa-key fa-lg"></i>&nbsp;&nbsp;&nbsp;<a
                    href="{{url('/changepassword')}}">Change your
                    password</a></li><br>
            <li><i class="fa fa-map-marker fa-lg"></i>&nbsp;&nbsp;&nbsp;<a
                    href="{{url('/modifyaddress')}}">Modify your
                    address</a></li><br>
        </ul>
    </div>
</div>
<div class="col-md-4">
    <div class="page-title-base">
        <h1 class="title-base">My Orders</h1>
    </div>
    <br>
    <div class="links-list">
        <ul style="list-style: none;">
            <li><i class="fa fa-archive fa-lg"></i>&nbsp;&nbsp;&nbsp;<a
                    href="{{url('/showorders')}}">View your order
                    history</a></li><br>
            <li><i class="fa fa-reply-all fa-lg"></i>&nbsp;&nbsp;&nbsp;<a
                    href="{{url('/showreturnrequests')}}">View your
                    return requests</a></li><br>
        </ul>
    </div>
</div>










@endsection

