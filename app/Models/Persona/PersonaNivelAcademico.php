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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaNivelAcademico withoutTrashed()
 * @mixin \Eloquent
 */
class PersonaNivelAcademico extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'persona_niveles_academicos';


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
