<?php

namespace App\Http\Requests\Api\Congregacion;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Congregacion\Bautizo;

class UpdateBautizoApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

         return Bautizo::$rules;

    }
}

