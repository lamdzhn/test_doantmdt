<?php
 $menus = config('menu');
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="width: 263px">
    <!-- Brand Logo -->
    <a href="{{ route('be.index') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @foreach ($menus as $menu)
                    <?php $class = !empty($menu['items']) ? 'has-treeview' : '' ?>
                    <li class="nav-item {{ $class }}">
                        <a href="{{ ($menu['route'] == '#') ? '#' : route($menu['route']) }}" class="nav-link">
                            <i class="nav-icon fa {{ $menu['icon'] }}"></i>
                            <p> {{ $menu['name'] }} </p>
                            @if (!empty($menu['items']))
                                <i class="right fa fa-angle-left"></i>
                            @endif
                        </a>
                        @if (!empty($menu['items']))
                            <ul class="nav nav-treeview">
                            @foreach ($menu['items'] as $menu_child)
                                    <li class="nav-item">
                                        <a href="{{ ($menu_child['route'] == '#') ? '#' : route($menu_child['route']) }}" class="nav-link">
                                            <i class="fa {{ $menu_child['icon'] }} nav-icon"></i>
                                            <p> {{ $menu_child['name'] }} </p>
                                        </a>
                                    </li>
                            @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
