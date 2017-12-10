<?php

namespace App;

use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use ValidationTrait;

    protected $fillable = ['name', 'acronym', 'description', 'active'];
    protected $hidden = ['created_at','updated_at'];

    protected $rules = [
        'name'          => 'required|max:255|min:5',
        'acronym'       => 'required|max:10',
        'description'   => 'required|max:255',
        'active'        => 'bool'
    ];

    public static function getAllMarkets()
    {
        return self::all();
    }

    public static function getActiveMarkets()
    {
        return self::where('active', 1)->get();
    }
}
