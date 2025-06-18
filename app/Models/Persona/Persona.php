<?php

namespace App\Models\Persona;


use App\Models\Ministerio\Ministerio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property int $id
 * @property string $primer_nombre
 * @property string|null $segundo_nombre
 * @property string $primer_apellido
 * @property string|null $segundo_apellido
 * @property string $telefono
 * @property string $direccion
 * @property string|null $email
 * @property int $ministerio_id
 * @property int $estado_id
 * @property \Illuminate\Support\Carbon|null $fecha_nacimiento
 * @property string $correlativo
 * @property string|null $dpi
 * @property int $nivel_academico_id
 * @property int $genero_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property-read \App\Models\Persona\PersonaEstado $personaEstado
 * @property-read \App\Models\Persona\PersonaGenero $personaGenero
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereCorrelativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereDpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereFechaNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereGeneroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereMinisterioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereNivelAcademicoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona wherePrimerApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona wherePrimerNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereSegundoApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereSegundoNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Persona withoutTrashed()
 * @mixin \Eloquent
 */
class Persona extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'personas';


    protected $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'telefono',
        'direccion',
        'email',
        'ministerio_id',
        'estado_id',
        'fecha_nacimiento',
        'correlativo',
        'dpi',
        'nivel_academico_id',
        'genero_id'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'primer_nombre' => 'string',
        'segundo_nombre' => 'string',
        'primer_apellido' => 'string',
        'segundo_apellido' => 'string',
        'telefono' => 'string',
        'direccion' => 'string',
        'email' => 'string',
        'ministerio_id' => 'integer',
        'estado_id' => 'integer',
        'fecha_nacimiento' => 'date',
        'correlativo' => 'string',
        'dpi' => 'string',
        'nivel_academico_id' => 'integer',
        'genero_id' => 'integer',
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
        'primer_nombre' => 'required|string|max:120',
        'segundo_nombre' => 'nullable|string|max:120',
        'primer_apellido' => 'required|string|max:120',
        'segundo_apellido' => 'nullable|string|max:120',
        'telefono' => 'required|string|max:12',
        'direccion' => 'required|string',
        'email' => 'nullable|string|max:150',
        'ministerio_id' => 'required|integer',
        'estado_id' => 'required|integer',
        'fecha_nacimiento' => 'nullable|date',
        'correlativo' => 'required|string|max:10',
        'dpi' => 'nullable|string|max:13',
        'nivel_academico_id' => 'required|integer',
        'genero_id' => 'required|integer',
    ];


    /**
     * Custom messages for validation
     *
     * @var array
     */
    public static $messages = [

    ];

    protected $appends = [
        'nombre_completo',
    ];


    /**
     * Accessor for relationships
     *
     * @var array
     */
    public function ministerio()
    {
        return $this->belongsTo(Ministerio::class, 'ministerio_id', 'id');
    }

    public function estado()
    {
        return $this->belongsTo(PersonaEstado::class, 'estado_id', 'id');
    }

    public function genero()
    {
        return $this->belongsTo(PersonaGenero::class, 'genero_id', 'id');
    }

    public function nivelAcademico()
    {
        return $this->belongsTo(PersonaNivelAcademico::class, 'nivel_academico_id', 'id');
    }

    /**
     * Accessor to get the full name of the person
     *
     * @return string
     */
    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->primer_nombre} {$this->segundo_nombre} {$this->primer_apellido} {$this->segundo_apellido}");
    }

}
