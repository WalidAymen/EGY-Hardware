@extends('layout')
@section('title')
    Log in or Register
@endsection
@section('body')
    <div class="col-sm-9 padding-right ">
        <section id="form">
            <!--form-->
            @include('errorrs')
            <div class="col-sm-5">
                <div class="login-form">
                    <!--login form-->
                    <h2>Login to your account</h2>
                    <form method="POST" action="{{ url('/login') }}">
                        @csrf
                        <input type="email" placeholder="Email Address" name="email" />
                        <input type="password" placeholder="Password" name="password" />
                        <span>
                            <input type="checkbox" class="checkbox" name="remember">
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-2">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-5">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form method="POST" action="{{ url('/register') }}">
                        @csrf
                        <input type="text" placeholder="Name" name="name" />
                        <input type="email" placeholder="Email Address" name="email" />
                        <input type="text" placeholder="Phone number" name="phone" />
                        <input type="password" placeholder="Password" name="password" />
                        <input type="password" placeholder="Confirm Password" name="password_confirmation" />
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
    </section>
    <!--/form-->
    </div>
@endsection
