<?php

namespace App\Models\Persona;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property string $nombre
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Familia withoutTrashed()
 * @mixin \Eloquent
 */
class Familia extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'familias';


    protected $fillable = [
        'nombre'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
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
    public static $rules = [
        'nombre' => 'required|string|max:100',
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

    public function personas(): BelongsToMany
    {
        return $this->belongsToMany(
            Persona::class,
            'personas_has_familias',
            'familias_id',
            'personas_id'
        );
    }

}
