<?php

namespace App\Models\Persona;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property int $id
 * @property string $descripcion
 * @property \Illuminate\Support\Carbon $fecha_registro
 * @property int $persona_id
 * @property int $user_registra_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora whereFechaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora wherePersonaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora whereUserRegistraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonaBitacora withoutTrashed()
 * @mixin \Eloquent
 */
class PersonaBitacora extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'persona_bitacoras';


    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_registro',
        'persona_id',
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
        'persona_id' => 'integer',
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
        'fecha_registro' => 'required|date',
        'persona_id' => 'required|integer',
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
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    public function userRegistra()
    {
        return $this->belongsTo(User::class, 'user_registra_id', 'id');
    }

}
