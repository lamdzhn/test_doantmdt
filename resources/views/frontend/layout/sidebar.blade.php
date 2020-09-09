<!-- Sidebar -->
<div class="sidebar" style="width: 320px">
    <!-- Logo -->
    <div class="sidebar_logo">
        <a href="#"><div>a<span>star</span></div></a>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar_nav">
        <ul>
            <li><a href="{{ route('fe.index') }}">Trang chủ<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            <li><a href="{{ route('fe.men.index') }}">Đồ nam<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            <li><a href="#">Đồ nữ<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            <li><a href="#">Liên hệ<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
        </ul>
    </nav>

    <!-- Search -->
    <div class="search">
        <form action="#" class="search_form" id="sidebar_search_form">
            <input type="text" class="search_input" placeholder="Tìm kiếm sản phẩm ..." required="required">
            <button class="search_button"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
    </div>

    <!-- Cart -->
    <div class="cart d-flex flex-row align-items-center justify-content-start">
        <div class="cart_icon"><a href="#">
                <img src="{{ asset('images/bag.png') }}" alt="Giỏ hàng">
                <div class="cart_num">2</div>
            </a></div>
        <div class="cart_text">Giỏ hàng</div>
        <div class="cart_price">399.000vnđ</div>
    </div>
</div>
