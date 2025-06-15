<?php

namespace App\Http\Requests\Api\admin\ModuloUsuarios;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

            return User::$rules;

    }
}

