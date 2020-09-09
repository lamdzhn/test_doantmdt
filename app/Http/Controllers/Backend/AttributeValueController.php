<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Attribute_value;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->permission == 1) {
            $attribute_values = Attribute_value::getAllAttributeValuePagination();
            return view('backend.attribute_value.index')->with('attribute_values', $attribute_values);
        }

        echo '<script>';
        echo 'alert("Bạn không có quyền truy cập vào trang này");';
        echo 'window.location.href="http://doan.test/backend/login";';
        echo '</script>';
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
            return view('backend.attribute_value.create')->with('categories', $categories);
        }

        echo '<script>';
        echo 'alert("Bạn không có quyền truy cập vào trang này");';
        echo 'window.location.href="http://doan.test/backend/login";';
        echo '</script>';
    }

    public static function getAttributes()
    {
        $attributes = Attribute::getAllAttribute();
        foreach ($attributes as $attribute) {
            echo '<div class="form-group">';
                echo '<label>'.$attribute->name.'</label>';
                echo '<input type="hidden" name="attribute_'.$attribute->id.'" value="'.$attribute->id.'">';
                echo '<input type="text" placeholder="---" class="form-control" name="attribute_value_'.$attribute->id.'" data-role="tagsinput">';
            echo '</div>';
        }
        echo '<link rel="stylesheet" href="'.asset('dist/css/bootstrap-tagsinput.css').'">';
        echo '<script src="'.asset('dist/js/bootstrap-tagsinput.js').'"></script>';
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
        if (!$request->has('attribute_value_'.$i)) {
            $errors = new MessageBag(['null_attribute_value' => 'Vui lòng chọn danh mục và nhập đầy đủ các giá trị thuộc tính']);
            return redirect()->back()->withInput()->withErrors($errors);
        }

        while($request->has('attribute_value_'.$i)) {
            $attribute_value_name = 'attribute_value_'.$i;
            $attribute_name = 'attribute_'.$i;
            if ($request->$attribute_value_name == '') {
                $errors = new MessageBag(['null_attribute_value' => 'Vui lòng nhập đầy đủ các giá trị thuộc tính']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
            $attribute_values[] = [$request->$attribute_name, explode(',', $request->$attribute_value_name)];
            $i = $i + 1;
        }

        if (Attribute_value::createAttributeValue($request->category_id, $attribute_values)) {
            echo '<script>';
            echo 'alert("Thêm các giá trị thuộc tính thành công");';
            echo 'window.location.href="http://doan.test/backend/index/attribute-value"';
            echo '</script>';
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
