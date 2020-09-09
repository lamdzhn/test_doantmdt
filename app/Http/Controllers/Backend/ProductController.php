<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Attribute_value;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_attribute_value;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use mysql_xdevapi\Exception;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->permission == 1) {
            $categories = Category::getCategoryFirstLevel();
            return view('backend.product.create')->with(['categories' => $categories]);
        }

        echo '<script>';
        echo 'alert("Bạn không có quyền truy cập vào trang này");';
        echo 'window.location.href="http://doan.test/backend/login";';
        echo '</script>';
    }

    public function get_attributes()
    {
        $attributes = Attribute::getAllAttribute();
        $i = 1;
        echo '<div class="form-group">';
            echo '<label>Thuộc tính sản phẩm</label>';
            foreach ($attributes as $attribute) {
                echo '<input type="hidden" name="attribute_id_'.$i.'" value="'.$attribute->id.'">';
                $attribute_values = DB::table('attribute_values')->where('attribute_id', '=', $attribute->id)->where('category_id', '=', $_POST['category_id'])->orderBy('id')->get();
                echo '<div class="form-group">';
                    echo '<label>'.$attribute->name.'</label>';
                    echo '<select multiple="multiple" name="attribute_'.$i.'" id="attribute_'.$i.'" style="width: 100%">';
                        foreach ($attribute_values as $attribute_value) {
                            echo '<option value="'.$attribute_value->id.'">'.$attribute_value->value.'</option>';
                        }
                    echo '</select>';
                echo '</div>';
                echo '<script>';
                    echo '$("#attribute_'.$i.'").select2()';
                echo '</script>';
                $i = $i + 1;
            }
            echo '<button type="button" class="btn btn-primary" onclick="createVariants()">Tạo biến thể</button>';
        echo '</div>';

        echo '<div id="variants_box"></div>';
    }

    public function create_variants()
    {
        $attributes = $_POST['attributes'];
        $variants = array();

        foreach ($attributes as $index=>$attribute) {
            foreach ($attributes[$index] as $color) {
                if (isset($attributes[$index+1])) {
                    foreach ($attributes[$index+1] as $size) {
                        $variant = array($color, $size);
                        array_push($variants, $variant);
                    }
                }
            }
        }

        $i = 1;

        foreach ($variants as $variant) {
            $j = 1;
            $z = DB::table('attributes')->min('id');
            echo '<div id="variant_'.$i.'">';
                echo '<button class="btn btn-primary form-control" type="button" data-toggle="collapse" data-target="#collapse_variant_'.$i.'" aria-expanded="false" aria-controls="collapse_variant_'.$i.'">Biến thể '.$i.'</button>';
                echo '<hr>';

                echo '<div class="collapse" id="collapse_variant_'.$i.'">';
                    echo '<div class="card card-body">';
                        echo '<label>Ảnh cho biến thể</label>';
                        echo '<div class="form-group">';
                              echo '<input required style="width:100%" type="file" name="image_'.$i.'" accept="image/png, image/jpg, image/jpeg">';
                        echo '</div>';

                        while (isset($variant[$j-1])) {
                            echo '<label>'.Attribute::getAttributeById($z)->name.'</label>';
                            echo '<div class="form-group">';
                                echo '<input type="hidden" name="attribute_value_id_' .$i.'_'.$j.'" value="'.$variant[$j-1].'">';
                                echo '<input type="text" class="form-control" readonly value="'.Attribute_value::getAttributeValueById($variant[$j-1])->value.'">';
                            echo '</div>';
                            $j = $j + 1;
                            $z = $z + 1;
                        }

                        echo '<label>Số lượng</label>';
                        echo '<div class="form-group">';
                            echo '<input type="number" class="form-control" required name="quantity_'.$i.'" placeholder="Số lượng sản phẩm">';
                        echo '</div>';

                        echo '<label>Giá (Đơn vị: vnđ)</label>';
                        echo '<div class="form-group">';
                            echo '<input type="number" class="form-control" required name="price_'.$i.'" placeholder="Giá sản phẩm">';
                        echo '</div>';

                        echo '<label>Giá khuyến mãi nếu có (Đơn vị: vnđ)</label>';
                        echo '<div class="form-group">';
                            echo '<input type="number" class="form-control" name="sale_price_'.$i.'" placeholder="Giá khuyến mãi của sản phẩm">';
                        echo '</div>';

                        echo '<div class="form-group">';
                            echo '<button class="btn btn-danger form-control" type="button" onclick="deleteAttribute('.$i.')">Xóa biến thể</button>';
                        echo '</div>';

                    echo '</div>';
                echo '</div>';

            echo '</div>';
            $i = $i + 1;
        }

        echo '<script>';
        echo 'alert("Đã thêm tổng cộng '.($i-1).' biến thể")';
        echo '</script>';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $i = 1;
        $j = 1;
        $variant = [];
        $variants = [];

        while ($request->has('attribute_value_id_'.$i.'_'.$j)) {
            $name_attribute = 'attribute_id_'.$j;
            $custom_name_attribute = 'attribute_id_'.$j;
            $name_attribute_value = 'attribute_value_id_'.$i.'_'.$j;
            $custom_name_attribute_value = 'attribute_value_id_'.$j;
            $variant += [$custom_name_attribute => $request->$name_attribute , $custom_name_attribute_value => $request->$name_attribute_value];

            $j = $j + 1;

            if (!$request->has('attribute_value_id_'.$i.'_'.$j)) {
                $name_image = 'image_'.$i;
                $image = $request->$name_image;
                $name_quantity = 'quantity_'.$i;
                $quantity = $request->$name_quantity;
                $name_price = 'price_'.$i;
                $price = $request->$name_price;
                $name_sale_price = 'sale_price_'.$i;
                $sale_price = $request->$name_sale_price;
                $variant += ['image' => $image ,'quantity' => $quantity, 'price' => $price, 'sale_price' => $sale_price];
                $variants[] = json_encode($variant);
                $variant = [];
                $i = $i + 1;
                $j = 1;
            }
        }

        $rules = [
            'name' => 'required|unique:products,name',
            'slug' => 'required|unique:products,slug',
            'description_short' => 'required',
            'description_long' => 'required',
            'category_id' => 'required',
        ];

        $messages = [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.unique' => 'Sản phẩm đã tồn tại',
            'slug.required' => 'Vui lòng nhập đường dẫn tĩnh cho sản phẩm',
            'slug.unique' => 'Đường dẫn tĩnh của sản phẩm đã tồn tại',
            'description_short.required' => 'Vui lòng nhập mô tả ngắn cho sản phẩm',
            'description_long.required' => 'Vui lòng nhập mô tả dài cho sản phẩm',
            'category_id.required' => 'Vui lòng chọn danh mục cho sản phẩm',
        ];

        $validates = validator($request->all(), $rules, $messages);
        if ($validates->fails()) {
            return redirect()->back()->withInput()->withErrors($validates);
        }

        if (count($variants) == 0) {
            $errors = new MessageBag(['null_attributes' => 'Vui lòng thêm thuộc tính sản phẩm (Yêu cầu chọn danh mục sản phẩm trước)']);
            return redirect()->back()->withInput()->withErrors($errors);
        }

        DB::beginTransaction();
        try {
            $product_insert_id = DB::table('products')->insertGetId(array('user_id' => Auth::user()->id, 'category_id' => $request->category_id, 'name' => $request->name, 'slug' => $request->slug, 'description_short' => $request->description_short, 'description_long' => $request->description_long, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()));
            Product_attribute_value::createProductAttributeValue($product_insert_id, $variants);
            foreach ($variants as $index=>$variant) {
                $image_name = 'image_'.($index+1);
                $path = public_path('images/backend/products/'.$request->slug.'/variants/');
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $name = explode(".", $_FILES[$image_name]['name']);
                $filename = $image_name.'.'.end($name);
                $request->$image_name->move($path, public_path('images/backend/products/'.$request->slug.'/variants/'.$filename));
            }

            DB::commit();
            echo '<script>';
            echo 'alert("Thêm sản phẩm thành công");';
            echo 'window.location.href="http://doan.test/backend/index/product"';
            echo '</script>';
        }
        catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e);
        }
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
