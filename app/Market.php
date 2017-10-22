<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = ['name', 'description', 'active'];

    protected $hidden = ['created_at','updated_at'];

    public static function getAllMarkets()
    {
        return self::all();
    }

    public static function getActiveMarkets()
    {
        return self::where('active', 1)->get();
    }
}
