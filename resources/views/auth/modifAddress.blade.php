@extends('layout')
@section('title')
Modify your address
@endsection
@section('body')

<div class="col-sm-9 padding-right ">
    @include('errorrs')

    <div class="signup-form">
        <!--sign up form-->
        <h2>Modify your address</h2>
        <form method="POST" action="{{ url('/modifyaddress') }}">
            @csrf
            <select class="form-select" aria-label="Default select example" name="city">
                @if ($user->city != null)
                <option selected>{{$user->city}}</option>
                @endif
                @foreach ($govs as $gov)
                    @if ($gov->name != $user->city)
                        <option>{{$gov->name}}</option>
                    @endif
                @endforeach
              </select> <br><br>
            <input type="text" placeholder="Enter Your Address" name="address" value="{{$user->address}}"/>
            <button type="submit" class="btn btn-default">Update</button>
        </form>
    </div>

</div>

@endsection

