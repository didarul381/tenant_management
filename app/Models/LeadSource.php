<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\LeadSource
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $created_by
 * @property int|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read User|null $user
 *
 * @method static Builder|LeadSource newModelQuery()
 * @method static Builder|LeadSource newQuery()
 * @method static Builder|LeadSource onlyTrashed()
 * @method static Builder|LeadSource query()
 * @method static Builder|LeadSource whereId($value)
 * @method static Builder|LeadSource whereName($value)
 * @method static Builder|LeadSource whereDescription($value)
 * @method static Builder|LeadSource whereCreatedBy($value)
 * @method static Builder|LeadSource whereDeletedBy($value)
 * @method static Builder|LeadSource whereCreatedAt($value)
 * @method static Builder|LeadSource whereUpdatedAt($value)
 * @method static Builder|LeadSource whereDeletedAt($value)
 * @method static Builder|LeadSource withTrashed()
 * @method static Builder|LeadSource withoutTrashed()
 * @mixin \Eloquent
 */
class LeadSource extends Model
{
    use SoftDeletes;

    protected $table = 'lead_sources';

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'deleted_by',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'created_by' => 'integer',
        'deleted_by' => 'integer',
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
    ];

    /**
     * Relation with User (creator).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
