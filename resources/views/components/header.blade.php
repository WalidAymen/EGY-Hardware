<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <form id="logout-form" style="display: hidden;" action="{{url('/logout')}}" method="post">
                @csrf
            </form>
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 01096330868</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> walid.alweshahy@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="https://www.facebook.com/lrdwalid/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://github.com/WalidAymen"><i class="fab fa-github"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/walid-elweshahy-63a53b196/"><i class="fa fa-linkedin"></i></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{url('/index')}}"><img src="{{ asset("images/home/logo.png")}}" alt="" /></a>

                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav ">
                            @auth
                            @if ($user->role!='customer')
                            <li><a href="{{url('/admin/pindingorders')}}"><i class="fas fa-tools"></i> Dash Board
                                </a></li>
                            @endif
                            <li><a href="{{url('/cart/'.$cart->id)}}"><i class="fa fa-shopping-cart"></i> Cart
                                @if (count($cart->products)>0)
                                <span class="badge badge-light">{{count($cart->products)}}</span>
                                @endif </a></li>
                            <li class="dropdown"><a href="{{url('/profile')}}">{{$cart->user->name}}<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                      <a class="text-center" href="{{url('/profile')}}"><h6>profile</h6></a>
                                      <a id="logout-link" class="text-center" href="#"><h6>Logout</h6></a>
                                </ul>
                            </li>
                            @endauth
                            @guest
                            <li><a href="{{url('/login')}}"><i class="fa fa-lock"></i> Login</a></li>
                            <li><a href="{{url('/register')}}"><i class="fa fa-lock"></i> Register</a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{url('/index')}}" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Categorys<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach ($cats as $cat)
                                        <li ><a  href="{{url("/cat/$cat->id")}}">{{$cat->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{url("/contactus")}}">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="{{url("/search")}}" method="get">
                            <input type="text" placeholder="Search for product" name="keyword"/>
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
