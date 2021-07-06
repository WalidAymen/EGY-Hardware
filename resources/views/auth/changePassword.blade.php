@extends('layout')
@section('title')
    Change your password
@endsection
@section('body')

    <div class="col-sm-9 padding-right ">
        @include('errorrs')

        <div class="signup-form">
            <!--sign up form-->
            <h2>Change your password</h2>
            <form method="POST" action="{{ url('/changepassword') }}">
                @csrf
                <input type="password" placeholder="Old Password" name="old_password" />
                <input type="password" placeholder="New Password" name="password" />
                <input type="password" placeholder="Confirm New Password" name="password_confirmation" />
                <button type="submit" class="btn btn-default">Change password</button>
            </form>
        </div>

    </div>

@endsection
