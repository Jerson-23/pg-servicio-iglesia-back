<?php

namespace App\Http\Requests\Api\Persona;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Persona\Familia;

class UpdateFamiliaApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

         return Familia::$rules;

    }
}

