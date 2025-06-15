<?php

namespace App\Http\Requests\Api\admin\ModuloUsuarios;

use App\Models\UserEstado;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserEstadoApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

            return UserEstado::$rules;

    }
}

