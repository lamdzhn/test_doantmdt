<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Attribute_value extends Model
{
    use Notifiable;

    protected $table = 'attribute_values';

    protected $fillable = ['value'];

    public static function getAllAttributeValue()
    {
        return DB::table('attribute_values')->orderBy('id')->get();
    }

    public static function getAllAttributeValuePagination()
    {
        return DB::table('attribute_values')->orderBy('id')->paginate(10);
    }

    public static function getAttributeValueById($id)
    {
        return DB::table('attribute_values')->where('id', '=', $id)->first();
    }

    public static function createAttributeValue($category_id, $attribute_values) {
        foreach ($attribute_values as $attribute_value) {
            foreach ($attribute_value[1] as $value) {
                $attribute_value_insert = new Attribute_value();
                $attribute_value_insert->category_id = $category_id;
                $attribute_value_insert->attribute_id = $attribute_value[0];
                $attribute_value_insert->value = $value;
                $attribute_value_insert->save();
            }
        }
        return true;
    }
}
