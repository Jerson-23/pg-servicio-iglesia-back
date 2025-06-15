<?php

namespace App\Http\Requests\Api\admin\ModuloUsuarios;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;


class CreateUserApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return User::$rules;
    }

    public function messages()
    {
        return User::$messages;
    }
}

