<?php

namespace App\Http\Requests\Api\admin\ModuloUsuarios;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return Permission::$rulesUpdated;

    }
}

