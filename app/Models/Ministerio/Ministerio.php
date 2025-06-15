<?php

namespace App\Models\Ministerio;


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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ministerio withoutTrashed()
 * @mixin \Eloquent
 */
class Ministerio extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $table = 'ministerios';


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
