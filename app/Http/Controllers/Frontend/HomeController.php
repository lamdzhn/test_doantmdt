<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public static function show_products($category)
    {
        $products = array(
            ['name' => 'Long red shirt',
                'price' => '199.000',
                'img' => 'images/product_1.jpg',
                'category' => 'bestseller'],
            ['name' => 'Hype grey shirt',
                'price' => '399.000',
                'img' => 'images/product_3.jpg',
                'category' => 'new'],
            ['name' => 'Long sleeve jacket',
                'price' => '900.000',
                'sale_price' => '350.000',
                'img' => 'images/product_2.jpg',
                'category' => 'bestseller'],
        );
        echo '<div class="products_container grid" id="products_box">';
        echo '<div id="loading-ajax" style="text-align: center; display: none">';
        echo '<img src="images/ajax-loader.gif" id="loading-ajax">';
        echo '</div>';
        foreach ($products as $product) {
            if ($product['category'] == $category) {
                /*Product*/
                echo '<div class="product grid-item">';
                    echo '<div class="product_inner">';
                        echo '<div class="product_image">';
                            echo '<img src="'.$product['img'].'" alt="">';
                            echo '<div class="product_tag" style="background: #fd006b; width: 100px">'.$product['category'].'</div>';
                        echo '</div>';
                        echo '<div class="product_content text-center">';
                            echo '<div class="product_title"><a href="#">'.$product['name'].'</a></div>';
                            if (isset($product['sale_price'])) {
                                echo '<div class="product_price">'.$product['sale_price'].'vnđ<span>Giá cũ '.$product['price'].'vnđ</span></div>';
                            }
                            else {
                                echo '<div class="product_price">'.$product['price'].'vnđ</div>';
                            }
                            echo '<div class="product_button ml-auto mr-auto trans_200"><a href="#">add to cart</a></div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        }
        echo '</div>';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
