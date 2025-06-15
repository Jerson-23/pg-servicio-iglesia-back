<?php

namespace App\Http\Requests\Api\admin\ModuloUsuarios;

use App\Models\Rol;
use Illuminate\Foundation\Http\FormRequest;


class CreateRolApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

           return Rol::$rules;

    }
}

