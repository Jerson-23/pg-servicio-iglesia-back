<?php

namespace App\Http\Requests\Api\Evento;

use App\Models\Evento\Evento;
use Illuminate\Foundation\Http\FormRequest;


class CreateEventoApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return Evento::$rules;

    }
}

