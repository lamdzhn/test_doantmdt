<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Attribute extends Model
{
    use Notifiable;

    protected $table = 'attributes';

    protected $fillable = ['name'];

    public static function getAllAttribute()
    {
        return DB::table('attributes')->orderBy('id')->get();
    }

    public static function getAttributeById($id)
    {
        return DB::table('attributes')->where('id', '=', $id)->first();
    }
}
