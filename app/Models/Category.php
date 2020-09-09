<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use Notifiable;

    protected $table = 'categories';

    protected $fillable = ['name', 'slug'];

    public static function getAllCategory()
    {
        return DB::table('categories')->orderBy('id')->paginate(10);
    }

    public static function getCategoryFirstLevel()
    {
        return DB::table('categories')->where('parent_id', '=', 0)->orderBy('id')->get();
    }

    public static function getCategoryById($id)
    {
        return DB::table('categories')->where('id', '=', $id)->first();
    }

    public static function createCategory($request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = $request->parent_id;
        return $category->save();
    }
}
