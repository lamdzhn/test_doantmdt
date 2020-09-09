<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use Notifiable;

    protected $table = 'products';

    protected $fillable = ['name, slug'];

    public static function getProductById($id) {
        return DB::table('products')->where('id', '=', $id)->first();
    }
}
