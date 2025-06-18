<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Support\Arr;

class RoleFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        // Si envían un array, tomamos el primer valor
        $roleId = is_array($value) ? Arr::first($value) : $value;

        $query->whereHas('roles', function (Builder $query) use ($roleId) {
            $query->where('id', $roleId);
        });
    }
}
