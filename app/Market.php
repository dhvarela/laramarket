<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Market extends Model
{
    protected $fillable = ['name', 'description', 'active'];
    protected $hidden = ['created_at','updated_at'];

    public $errors;
    protected $rules = [
        'name'          => 'required|max:255|min:5',
        'description'   => 'required|max:255',
        'active'        => 'bool'
    ];

    public function validate($data) {
        $v = Validator::make($data,$this->rules);
        if ($v->fails()){
            $this->errors = $v->errors();
            return false;
        } else {
            return true;
        }
    }

    public static function getAllMarkets()
    {
        return self::all();
    }

    public static function getActiveMarkets()
    {
        return self::where('active', 1)->get();
    }
}
