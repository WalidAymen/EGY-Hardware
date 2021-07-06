@extends('layout')
@section('title')
    Contact Us
@endsection
@section('body')

@if (isset($settings->email))
<h2 class="text-info " style="margin-bottom: 2rem">Email :<b class="text-primary">{{$settings->email}}</b></h2>
@endif
@if (isset($settings->phone1))
<h2 class="text-info " style="margin-bottom: 2rem">Phone 1 :<b class="text-primary">{{$settings->phone1}}</b></h2>
@endif
@if (isset($settings->phone2))
<h2 class="text-info " style="margin-bottom: 2rem">Phone 2 :<b class="text-primary">{{$settings->phone2}}</b></h2>
@endif
@if (isset($settings->phone3))
<h2 class="text-info " style="margin-bottom: 2rem">Phone 3 :<b class="text-primary">{{$settings->phone3}}</b></h2>
@endif
@if (isset($settings->phone4))
<h2 class="text-info " style="margin-bottom: 2rem">Phone 4 :<b class="text-primary">{{$settings->phone4}}</b></h2>
@endif
@if (isset($settings->phone5))
<h2 class="text-info " style="margin-bottom: 2rem">Phone 5 :<b class="text-primary">{{$settings->phone5}}</b></h2>
@endif
@if (isset($settings->phone6))
<h2 class="text-info " style="margin-bottom: 2rem">Phone 6 :<b class="text-primary">{{$settings->phone6}}</b></h2>
@endif
@if (isset($settings->facebook))
<h2 class="text-info " style="margin-bottom: 2rem">Facebook :<a class="text-primary h2" href="{{$settings->facebook}}">{{$settings->facebook}}</a></h2>
@endif
@if (isset($settings->youtube))
<h2 class="text-info " style="margin-bottom: 2rem">Youtube :<a class="text-primary h2" href="{{$settings->youtube}}">{{$settings->youtube}}</a></h2>
@endif
@if (isset($settings->googleplus))
<h2 class="text-info " style="margin-bottom: 2rem">Googleplus :<a class="text-primary h2" href="{{$settings->googleplus}}">{{$settings->googleplus}}</a></h2>
@endif
@if (isset($settings->insta))
<h2 class="text-info " style="margin-bottom: 2rem">Instgram :<a class="text-primary h2" href="{{$settings->insta}}">{{$settings->insta}}</a></h2>
@endif
@if (isset($settings->twitter))
<h2 class="text-info " style="margin-bottom: 2rem">Twitter :<a class="text-primary h2" href="{{$settings->twitter}}">{{$settings->twitter}}</a></h2>
@endif
@if (isset($settings->tiktok))
<h2 class="text-info " style="margin-bottom: 2rem">Tiktok :<a class="text-primary h2" href="{{$settings->tiktok}}">{{$settings->tiktok}}</a></h2>
@endif
@if (isset($settings->snap))
<h2 class="text-info " style="margin-bottom: 2rem">Snap :<a class="text-primary h2" href="{{$settings->snap}}">{{$settings->snap}}</a></h2>
@endif
@if (isset($settings->whatsapp))
<h2 class="text-info " style="margin-bottom: 2rem">Whatsapp :<b class="text-primary">{{$settings->whatsapp}}</b></h2>
@endif

@auth
    <h1 class="text-center text-success " style="margin-top: 5rem">OR</h1>

    <div class=" col-md-9">
        <h2 class="text-info " style="margin-bottom: 2rem">Send message</h2>
        <form class="contact100-form validate-form" method="POST" action="{{url('/createmessage')}}">
            @csrf
            <div class="wrap-input100 validate-input" data-validate="Name is required">
                <input class="input100" type="text" name="tittle" placeholder="Message tittle(optinal)">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Message is required">
                <textarea class="input100" name="message" placeholder="Your message here..."></textarea>
                <span class="focus-input100"></span>
            </div>

            <div class="container-contact100-form-btn">
                <button class="contact100-form-btn">
                    <span>
                        Submit
                        <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
        </form>
    </div>

@endauth

@endsection
