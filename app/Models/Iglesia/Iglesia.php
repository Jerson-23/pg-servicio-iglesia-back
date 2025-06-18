<?php

namespace App\Models\Iglesia;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property int $pastor_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia wherePastorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Iglesia withoutTrashed()
 * @mixin \Eloquent
 */
class Iglesia extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'iglesias';


    protected $fillable =
        [
    'nombre',
    'direccion',
    'pastor_id'
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
        'direccion' => 'string',
        'pastor_id' => 'integer',
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
    'direccion' => 'required|string',
    'pastor_id' => 'required|integer',
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
    public function user()
    {
    return $this->belongsTo(User::class,'pastor_id','id');
    }

}
