<?php

namespace App\Models\Evento;


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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventoTipo withoutTrashed()
 * @mixin \Eloquent
 */
class EventoTipo extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'evento_tipos';


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
