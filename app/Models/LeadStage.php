<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\LeadStage
 *
 * @property int $id
 * @property string $name
 * @property int $sort_order
 * @property string $color
 * @property int|null $created_by
 * @property int|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read User|null $user
 *
 * @method static Builder|LeadStage newModelQuery()
 * @method static Builder|LeadStage newQuery()
 * @method static Builder|LeadStage onlyTrashed()
 * @method static Builder|LeadStage query()
 * @method static Builder|LeadStage whereId($value)
 * @method static Builder|LeadStage whereName($value)
 * @method static Builder|LeadStage whereSortOrder($value)
 * @method static Builder|LeadStage whereColor($value)
 * @method static Builder|LeadStage whereCreatedBy($value)
 * @method static Builder|LeadStage whereDeletedBy($value)
 * @method static Builder|LeadStage whereCreatedAt($value)
 * @method static Builder|LeadStage whereUpdatedAt($value)
 * @method static Builder|LeadStage whereDeletedAt($value)
 * @method static Builder|LeadStage withTrashed()
 * @method static Builder|LeadStage withoutTrashed()
 * @mixin \Eloquent
 */
class LeadStage extends Model
{
    use SoftDeletes;

    protected $table = 'lead_stages';

    protected $fillable = [
        'name',
        'sort_order',
        'color',
        'created_by',
        'description',
        'deleted_by',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'sort_order' => 'integer',
        'color' => 'string',
        'description' => 'string',
        'created_by' => 'integer',
        'deleted_by' => 'integer',
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'sort_order' => 'required|integer|min:0',
        'color' => 'required|string|in:primary,secondary,success,danger,warning,info,dark',
        'description' => 'nullable|string',
    ];

    /**
     * Relation with User (creator)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relation with Lead model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leads()
    {
        return $this->hasMany(Lead::class, 'stage_id');
    }
}
