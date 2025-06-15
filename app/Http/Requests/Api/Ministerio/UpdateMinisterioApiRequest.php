<?php

namespace App\Http\Requests\Api\Ministerio;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Ministerio\Ministerio;

class UpdateMinisterioApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

         return Ministerio::$rules;

    }
}

