<?php

namespace App\Models\Evento;


use App\Models\Congregacion\Bautizo;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property int $id
 * @property string $descripcion
 * @property \Illuminate\Support\Carbon|null $fecha_registro
 * @property int $bautiso_id
 * @property int $user_registra_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora whereBautisoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora whereFechaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora whereUserRegistraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BautizoBitacora withoutTrashed()
 * @mixin \Eloquent
 */
class BautizoBitacora extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'bautiso_bitacoras';


    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_registro',
        'bautiso_id',
        'user_registra_id'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string',
        'fecha_registro' => 'datetime',
        'bautiso_id' => 'integer',
        'user_registra_id' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required|string',
        'fecha_registro' => 'nullable|date',
        'bautiso_id' => 'required|integer',
        'user_registra_id' => 'required|integer',
    ];


    /**
     * Custom messages for validation
     *
     * @var array
     */
    public static $messages = [

    ];


    /**
     * Accessor for relationships
     *
     * @var array
     */
    public function bautiso()
    {
        return $this->belongsTo(Bautizo::class, 'bautiso_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_registra_id', 'id');
    }

}
