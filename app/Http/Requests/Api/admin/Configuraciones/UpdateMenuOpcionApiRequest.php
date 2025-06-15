<?php

namespace App\Http\Requests\Api\admin\Configuraciones;

use App\Models\MenuOpcion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuOpcionApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

            return MenuOpcion::$rules;

    }
}

