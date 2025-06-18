<?php

namespace App\Http\Requests\Api\Iglesia;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Iglesia\Iglesia;



class CreateIglesiaApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return Iglesia::$rules;

    }
}

