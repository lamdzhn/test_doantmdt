<!-- Header -->
<header class="header">
    <div class="header_content d-flex flex-row align-items-center justify-content-start">

        <!-- Hamburger -->
        <div class="hamburger menu_mm"><i class="fa fa-bars menu_mm" aria-hidden="true"></i></div>

        <!-- Logo -->
        <div class="header_logo">
            <a href="#"><div>a<span>star</span></div></a>
        </div>

        <!-- Navigation -->
        <nav class="header_nav">
            <ul class="d-flex flex-row align-items-center justify-content-start">
                <li><a href="{{ route('fe.index') }}">home</a></li>
                <li><a href="#">woman</a></li>
                <li><a href="#">man</a></li>
                <li><a href="#">contact</a></li>
            </ul>
        </nav>

        <!-- Header Extra -->
        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">

            <!-- Cart -->
            <div class="cart d-flex flex-row align-items-center justify-content-start">
                <div class="cart_icon"><a href="#">
                        <img src="{{ asset('images/bag.png') }}" alt="">
                        <div class="cart_num">2</div>
                    </a></div>
            </div>

        </div>

    </div>
</header>

<!-- Menu -->

<div class="menu d-flex flex-column align-items-start justify-content-start menu_mm trans_400">
    <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
    <div class="menu_top d-flex flex-row align-items-center justify-content-start">
        <!-- Logo -->
        <div class="sidebar_logo">
            <a href="#"><div>a<span>star</span></div></a>
        </div>
    </div>
    <div class="menu_search">
        <form action="#" class="header_search_form menu_mm">
            <input type="search" class="search_input menu_mm" placeholder="Search" required="required">
            <button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
                <i class="fa fa-search menu_mm" aria-hidden="true"></i>
            </button>
        </form>
    </div>
    <nav class="menu_nav">
        <ul class="menu_mm">
            <li class="menu_mm"><a href="{{ route('fe.index') }}">Trang chủ</a></li>
            <li class="menu_mm"><a href="{{ route('fe.men.index') }}">Đồ nam</a></li>
            <li class="menu_mm"><a href="#">Đồ nữ</a></li>
            <li class="menu_mm"><a href="#">contact</a></li>
        </ul>
    </nav>
    <div class="menu_extra">
        <div class="menu_social">
            <ul>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>
