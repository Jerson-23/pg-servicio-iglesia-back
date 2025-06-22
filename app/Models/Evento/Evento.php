<?php

namespace App\Models\Evento;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $tipo_id
 * @property \Illuminate\Support\Carbon|null $fecha
 * @property string|null $hora
 * @property string|null $direccion
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property-read \App\Models\Evento\EventoTipo $eventoTipo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evento withoutTrashed()
 * @mixin \Eloquent
 */
class Evento extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'eventos';


    protected $fillable =
        [
    'nombre',
    'descripcion',
    'tipo_id',
    'fecha',
    'hora',
    'direccion'
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
        'descripcion' => 'string',
        'tipo_id' => 'integer',
        'fecha' => 'datetime',
        'hora' => 'string',
        'direccion' => 'string',
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
    'descripcion' => 'required|string',
    'tipo_id' => 'required|integer',
    'fecha' => 'nullable|date',
    'hora' => 'nullable|string',
    'direccion' => 'nullable|string',
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
    public function eventoTipo()
    {
    return $this->belongsTo(EventoTipo::class,'tipo_id','id');
    }

}
