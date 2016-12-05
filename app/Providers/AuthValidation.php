<?php
namespace App\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Validator;

class AuthValidation extends Validator {
    public function validateUser($attribute, $value, $parameters)
    {
        if($value == null){

            return false;
           // return redirect('register')->with('message', 'Зарегистрируйтесь');
        }
        else return true;
    }
}