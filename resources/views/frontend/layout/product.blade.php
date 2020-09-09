<!-- Products -->
<div class="products">
    @if($page_title != 'Trang chủ')
        <div class="products_bar">
            <div class="section_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="products_bar_content d-flex flex-column flex-xxl-row align-items-start align-items-xxl-center justify-content-start">
                                <div class="product_categories">
                                    <ul class="d-flex flex-row align-items-start justify-content-start flex-wrap">
                                        <li><a href="{{ route('fe.men.index') }}">Đồ nam</a></li>
                                        <li><a href="#">Quần nam</a></li>
                                        <li><a href="#">Áo nam</a></li>
                                        <li><a href="#">Giày nam</a></li>
                                    </ul>
                                </div>
                                <div class="products_bar_side ml-xxl-auto d-flex flex-row align-items-center justify-content-start">
                                    <div class="products_dropdown product_dropdown_sorting">
                                        <div class="isotope_sorting_text"><span>Sắp xếp</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                        <ul>
                                            <li class="item_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;original-order&quot;}">Mặc định</li>
                                            <li class="item_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;price&quot; , &quot;sortAscending&quot;: true }">Giá thấp đến cao</li>
                                            <li class="item_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;price&quot; , &quot;sortAscending&quot;: false }">Giá cao đến thấp</li>
                                            <li class="item_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;name&quot; , &quot;sortAscending&quot;: true }">Tên SP A-Z</li>
                                            <li class="item_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;name&quot; , &quot;sortAscending&quot;: false }">Tên SP Z-A</li>
                                        </ul>
                                    </div>
                                    <div class="products_dropdown text-right product_dropdown_filter">
                                        <div class="isotope_filter_text"><span>Bộ lọc</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                        <ul>
                                            <li class="item_filter_btn" data-filter="*">Tất cả SP</li>
                                            <li class="item_filter_btn" data-filter=".hot">Hot</li>
                                            <li class="item_filter_btn" data-filter=".new">Mới về</li>
                                            <li class="item_filter_btn" data-filter=".sale">Đang giảm giá</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="section_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    @if($page_title != 'Trang chủ')
                    <div class="products_container grid" id="products_box">
                                <!-- Product -->
                                <div class="product grid-item hot">
                                    <div class="product_inner">
                                        <div class="product_image">
                                            <img src="images/product_1.jpg" alt="">
                                            <div class="product_tag" style="width: 100px">hot</div>
                                        </div>
                                        <div class="product_content text-center">
                                            <div class="product_title"><a href="#">long red shirt</a></div>
                                            <div class="product_price">199.000đ</div>
                                            <div class="product_button ml-auto mr-auto trans_200"><a href="#">add to cart</a></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product -->
                                <div class="product grid-item">
                                    <div class="product_inner">
                                        <div class="product_image"><img src="images/product_2.jpg" alt=""></div>
                                        <div class="product_content text-center">
                                            <div class="product_title"><a href="#">hype grey shirt</a></div>
                                            <div class="product_price">399.000vnđ</div>
                                            <div class="product_button ml-auto mr-auto trans_200"><a href="#">add to cart</a></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product -->
                                <div class="product grid-item sale">
                                    <div class="product_inner">
                                        <div class="product_image">
                                            <img src="images/product_3.jpg" alt="">
                                            <div class="product_tag" style="background: #fd006b; width: 100px">sale</div>
                                        </div>
                                        <div class="product_content text-center">
                                            <div class="product_title"><a href="#">long sleeve jacket</a></div>
                                            <div class="product_price">350.000vnđ<span>Giá cũ 900.000vnđ</span></div>
                                            <div class="product_button ml-auto mr-auto trans_200"><a href="#">add to cart</a></div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    @else
                        <div id="products_box">
                            <div id="loading-ajax" style="text-align: center; display: none">
                                <img src="{{ asset('images/ajax-loader.gif') }}" id="loading-ajax">
                            </div>
                            <div class="products_container grid">
                                <!-- Product -->
                                <div class="product grid-item hot">
                                    <div class="product_inner">
                                        <div class="product_image">
                                            <img src="images/product_1.jpg" alt="">
                                            <div class="product_tag" style="width: 100px">hot</div>
                                        </div>
                                        <div class="product_content text-center">
                                            <div class="product_title"><a href="#">long red shirt</a></div>
                                            <div class="product_price">199.000đ</div>
                                            <div class="product_button ml-auto mr-auto trans_200"><a href="#">add to cart</a></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product -->
                                <div class="product grid-item">
                                    <div class="product_inner">
                                        <div class="product_image"><img src="images/product_2.jpg" alt=""></div>
                                        <div class="product_content text-center">
                                            <div class="product_title"><a href="#">hype grey shirt</a></div>
                                            <div class="product_price">399.000vnđ</div>
                                            <div class="product_button ml-auto mr-auto trans_200"><a href="#">add to cart</a></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product -->
                                <div class="product grid-item sale">
                                    <div class="product_inner">
                                        <div class="product_image">
                                            <img src="images/product_3.jpg" alt="">
                                            <div class="product_tag" style="background: #fd006b; width: 100px">sale</div>
                                        </div>
                                        <div class="product_content text-center">
                                            <div class="product_title"><a href="#">long sleeve jacket</a></div>
                                            <div class="product_price">350.000vnđ<span>Giá cũ 900.000vnđ</span></div>
                                            <div class="product_button ml-auto mr-auto trans_200"><a href="#">add to cart</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
