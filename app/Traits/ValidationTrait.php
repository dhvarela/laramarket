<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 19/11/17
 * Time: 21:22
 */

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait ValidationTrait
{
    public $errors;

    public function validate($data) {
        $v = Validator::make($data,$this->rules);
        if ($v->fails()){
            $this->errors = $v->errors();
            return false;
        } else {
            return true;
        }
    }
}