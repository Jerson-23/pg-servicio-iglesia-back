<?php

namespace App\Http\Requests\Api\Persona;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Persona\Persona;



class CreatePersonaApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return Persona::$rules;

    }
}

