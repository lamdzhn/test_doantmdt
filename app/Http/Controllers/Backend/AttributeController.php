<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->permission == 1) {
            $attributes = Attribute::getAllAttribute();
            return view('backend.attribute.index')->with('attributes', $attributes);
        }

        echo '<script>';
        echo 'alert("Bạn không có quyền truy cập vào trang này");';
        echo 'window.location.href="http://doan.test/backend/login";';
        echo '</script>';
    }
}
