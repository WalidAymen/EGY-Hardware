<footer id="footer">
    <!--Footer-->
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>Fast shopping by category</h2>
                        <ul class="nav nav-pills nav-stacked">
                            @foreach ($cats as $cat)
                                <li><a href="{{ url("/cat/$cat->id") }}">{{ $cat->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>Shortuts</h2>
                        <ul class="nav nav-pills nav-stacked">
                            @guest
                                <li><a href="{{ url('/login') }}">Registe/Login</a></li>
                            @endguest
                            @auth
                                <li><a href="{{ url('/profile') }}">Profile</a></li>
                                <li><a href="{{ url('/cart/' . $user->cart->id) }}">Cart</a></li>
                                <li><a href="{{ url('/showorders') }}">View my orders</a></li>
                                <li><a href="{{ url('/editinfo') }}">Edit account informations</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="single-widget ">
                        <h2>Send message</h2>
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
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2021 EGY-Hardware Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href=#>Walid</a></span></p>
            </div>
        </div>
    </div>

</footer>
<!--/Footer-->
