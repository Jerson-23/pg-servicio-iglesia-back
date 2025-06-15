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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamiliaTipo withoutTrashed()
 * @mixin \Eloquent
 */
class FamiliaTipo extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'familia_tipos';


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
    'nombre' => 'required|string|max:100',
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
