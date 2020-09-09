<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Product_attribute_value extends Model
{
    use Notifiable;

    protected $table = 'product_attribute_values';

    protected $casts = [
      'product_attribute_values' => 'array'
    ];

    public static function createProductAttributeValue($product_insert_id, $variants) {
        foreach ($variants as $value) {
            DB::table('product_attribute_values')->insert(array('product_id' => $product_insert_id, 'product_attribute_values' => $value, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()));
        }
        return true;
    }

    public static function getValueByProductId($product_id) {
        return DB::table('product_attribute_values')->where('product_id', '=', $product_id)->orderBy('id')->get();
    }
}
