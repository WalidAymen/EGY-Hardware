@extends('layout')
@section('title')
Edit your account information
@endsection
@section('body')

<div class="col-sm-9 padding-right ">
    @include('errorrs')

    <div class="signup-form">
        <!--sign up form-->
        <h2>Edit your account information</h2>
        <form method="POST" action="{{ url('/editinfo') }}">
            @csrf
            <input type="text" placeholder="Name" name="name" value="{{$user->name}}"/>
            <input type="email" placeholder="Email Address" name="email" value="{{$user->email}}"/>
            <input type="text" placeholder="Phone number" name="phone" value="{{$user->phone}}"/>
            <button type="submit" class="btn btn-default">Update</button>
        </form>
    </div>

</div>

@endsection

