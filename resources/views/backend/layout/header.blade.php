<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('be.index') }}" class="nav-link">Trang chủ</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Liên hệ</a>
        </li>
    </ul>
{{--
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                    <p>
                        {{ Auth::user()->name }} - Admin
                        <small>Admin kể từ 2020</small>
                    </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Thông tin</a>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('be.logout') }}" class="btn btn-default btn-flat">Đăng xuất</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>
