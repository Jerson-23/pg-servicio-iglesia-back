<?php

namespace App\Http\Requests\Api\Evento;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Evento\BautizoBitacora;

class UpdateBautizoBitacoraApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

         return BautizoBitacora::$rules;

    }
}

