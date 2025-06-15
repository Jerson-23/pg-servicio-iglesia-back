<?php

namespace App\Models\Persona;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaEstado withoutTrashed()
 * @mixin \Eloquent
 */
class PersonaEstado extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'persona_estados';


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
