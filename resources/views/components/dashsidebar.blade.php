<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ url('/admin/pindingorders') }}">
            <span class="align-middle">Dash Board</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item @yield('pinding')">
                <a class="sidebar-link" href="{{ url('/admin/pindingorders') }}">
                    <i class="fas fa-truck"></i> <span class="align-middle">Pinding
                        orders</span>
                </a>
            </li>

            <li class="sidebar-item @yield('allorders')">
                <a class="sidebar-link" href="{{ url('/admin/allorders') }}">
                    <i class="fas fa-truck-moving"></i> <span class="align-middle">All
                        orders</span>
                </a>
            </li>

            <li class="sidebar-item @yield('return')">
                <a class="sidebar-link" href="{{ url('/admin/returnrequest') }}">
                    <i class="fas fa-undo"></i> <span class="align-middle">Return
                        requests</span>
                </a>
            </li>
            @if ($user->role=='admin'||$user->role=='super_admin')
                <li class="sidebar-item @yield('addproduct')">
                    <a class="sidebar-link" href="{{ url('/admin/addproduct') }}">
                        <i class="far fa-plus-square"></i> <span class="align-middle">Add product</span>
                    </a>
                </li>
                <li class="sidebar-item @yield('allproducts')">
                    <a class="sidebar-link" href="{{ url('/admin/allproducts') }}">
                        <i class="fas fa-desktop"></i> <span class="align-middle">All products</span>
                    </a>
                </li>

                <li class="sidebar-item @yield('cat')">
                    <a class="sidebar-link" href="{{ url('/admin/cats') }}">
                        <i class="fas fa-memory"></i> <span
                            class="align-middle">Categorys</span>
                    </a>
                </li>

                <li class="sidebar-item @yield('brand')">
                    <a class="sidebar-link" href="{{ url('/admin/brands') }}">
                        <i class="fas fa-microchip"></i> <span
                            class="align-middle">Brands</span>
                    </a>
                </li>
            @endif

            @if ($user->role=='super_admin')
                <li class="sidebar-item @yield('user')">
                    <a class="sidebar-link" href="{{ url('/admin/users') }}">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span>
                    </a>
                </li>
            @endif



    </div>
</nav>
