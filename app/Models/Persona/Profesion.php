<?php

namespace App\Models\Persona;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesion withoutTrashed()
 * @mixin \Eloquent
 */
class Profesion extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'profesiones';


    protected $fillable =
        [
    'nombre'
];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts =
        [
        'id' => 'integer',
        'nombre' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];



    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules =
    [
    'nombre' => 'required|string|max:120',
];


    /**
     * Custom messages for validation
     *
     * @var array
     */
    public static $messages =[

    ];


    /**
     * Accessor for relationships
     *
     * @var array
     */


}
