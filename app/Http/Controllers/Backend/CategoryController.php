<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->permission == 1) {
            $categories = Category::getAllCategory();
            return view('backend.category.index')->with('categories', $categories);
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
            return view('backend.category.create')->with('categories', $categories);
        }

        echo '<script>';
        echo 'alert("Bạn không có quyền truy cập vào trang này");';
        echo 'window.location.href="http://doan.test/backend/login";';
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
        $rules = [
            'name' => 'required|unique:categories,name',
            'slug' => 'required'
        ];

        $messages = [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.unique' => 'Tên danh mục đã tồn tại, vui lòng thử lại',
            'slug.required' => 'Vui lòng nhập đường dẫn tĩnh của danh mục'
        ];

        $validates = validator($request->all(), $rules, $messages);
        if ($validates->fails()) {
            return redirect()->back()->withInput()->withErrors($validates);
        }

        if (Category::createCategory($request)) {
            echo '<script>';
            echo 'alert("Thêm danh mục mới thành công");';
            echo 'window.location.href="http://doan.test/backend/index/category";';
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
        DB::table('categories')->where('id', '=', $id)->update(['name' => $_POST['name'], 'slug' => $_POST['slug'], 'parent_id' => $_POST['parent_id'], 'updated_at' => Carbon::now()]);
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
    public function delete($id)
    {
        Category::destroy($id);
    }
}
