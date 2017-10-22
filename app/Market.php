<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = ['name', 'description'];

    protected $hidden = ['created_at','updated_at'];

    public static function getAllMarkets()
    {
        return self::all();
    }
}
