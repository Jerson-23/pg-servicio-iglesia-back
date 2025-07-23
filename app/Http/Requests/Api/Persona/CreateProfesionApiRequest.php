<?php

namespace App\Http\Requests\Api\Persona;

use App\Models\Persona\Profesion;
use Illuminate\Foundation\Http\FormRequest;


class CreateProfesionApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return Profesion::$rules;

    }
}

