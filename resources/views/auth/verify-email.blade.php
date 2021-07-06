@extends('layout')
@section('title')

@endsection
@section('body')
    <div class="alert alert-success col-sm-8 text-center col-sm-offset-1 p-3 ">
        <h3>A verification Email sent , check your Email inbox</h3>
            <form class="m-3 p-3" action="{{url('/email/verification-notification')}}" method="post">
                @csrf
                <button class="btn btn-danger " type="submit">Resend</button>
            </form>
    </div>
    <br>

@endsection
