<?php

namespace App\Models\Congregacion;


use App\Models\Evento\BautizoBitacora;
use App\Models\Iglesia\Iglesia;
use App\Models\Persona\Persona;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property string $observaciones
 * @property \Illuminate\Support\Carbon $fecha_bautiso
 * @property int $persona_id
 * @property int $user_registra_id
 * @property int $iglesia_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo whereFechaBautiso($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo whereIglesiaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo wherePersonaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo whereUserRegistraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bautizo withoutTrashed()
 * @mixin \Eloquent
 */
class Bautizo extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'bautisos';


    protected $fillable = [
        'observaciones',
        'fecha_bautiso',
        'hora_bautiso',
        'persona_id',
        'user_registra_id',
        'iglesia_id',
        'ministro_id',
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'observaciones' => 'string',
        'fecha_bautiso' => 'datetime',
        'hora_bautiso' => 'datetime:H:i',
        'persona_id' => 'integer',
        'user_registra_id' => 'integer',
        'iglesia_id' => 'integer',
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
        'observaciones' => 'required|string',
        'fecha_bautiso' => 'required|date',
        'persona_id' => 'required|integer',
        'user_registra_id' => 'required|integer',
        'iglesia_id' => 'required|integer',
        'hora_bautiso' => 'required|date_format:H:i',
        'ministro_id' => 'required|integer',
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
    public function iglesia()
    {
        return $this->belongsTo(Iglesia::class, 'iglesia_id', 'id');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    public function userRegistra()
    {
        return $this->belongsTo(User::class, 'user_registra_id', 'id');
    }

    public function participantes(): BelongsToMany
    {
        return $this->belongsToMany(Persona::class, 'bautisos_has_personas',
            'bautisos_id',
            'personas_id');
    }

    public function bitacoras()
    {
        return $this->hasMany(BautizoBitacora::class, 'bautiso_id', 'id');

    }

    public function ministroBautiza(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'ministro_id');

    }

}
