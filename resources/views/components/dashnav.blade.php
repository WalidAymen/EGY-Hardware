    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <form id="logout-dash-form" style="display: hidden;" action="{{url('/logout')}}" method="post">
            @csrf
        </form>
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                        data-bs-toggle="dropdown">
                        <div class="position-relative">
                            <i class="align-middle" data-feather="message-square"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                        aria-labelledby="messagesDropdown">
                        <div class="dropdown-menu-header">
                            <div class="position-relative">
                                Latest Messages
                            </div>
                        </div>
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    @foreach ( $messages as $message )
                                    <div class="col-10 ps-2 my-2 border p-3 w-100 rounded">
                                        <div class=" text-center"><span class="text-info h3">{{$message->user->name}}</span> <span class="small text-muted">({{$message->user->email}})</span> </div>
                                        <div class="text-center text-success medium mt-1 text-uppercase">{{$message->tittle}}</div>
                                        <div class="text-muted small mt-1">{{$message->body}}</div>
                                    </div>
                                    @endforeach

                                </div>
                            </a>
                        </div>
                        <div class="dropdown-menu-footer">
                            <a href="{{url("/admin/allmessages")}}" class="text-muted">Show all messages</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-icon" href="{{url("/index")}}" >
                        <div class="position-relative">
                            <i class="fas fa-home"></i>
                        </div>
                    </a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                        data-bs-toggle="dropdown">
                        <i class="align-middle" data-feather="settings"></i>
                    </a>

                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                        data-bs-toggle="dropdown">
                         <span class="text-dark">{{$user->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{url('/profile')}}"><i class="align-middle me-1"
                                data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <input id="logout-dash" class="dropdown-item" value="Log out" type="submit" form="logout-dash-form"/>
                    </div>
                </li>
            </ul>
        </div>

    </nav>
