<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommissionRule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'commission_rules';

    protected $fillable = [
        'total_percentage',
        'principal_percentage',
        'secondary_percentage',
        'priority',
        'created_by',
    ];

    protected $casts = [
        'total_percentage' => 'integer',
        'principal_percentage' => 'integer',
        'secondary_percentage' => 'integer',
        'priority' => 'integer',
        'created_by' => 'integer',
    ];

    public static $rules = [
        'total_percentage' => 'required|integer|min:1|max:100',
        'principal_percentage' => 'required|integer|min:0|max:100',
        'secondary_percentage' => 'required|integer|min:0|max:100',
        'projects' => 'required|array|min:1',
        'principal_users' => 'required|array|min:1',
        'secondary_users' => 'required|array|min:1',
        'priority' => 'required|integer|min:1',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'commission_rule_project')
            ->withTimestamps();
    }

    public function principalUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'commission_rule_principal_user')
            ->withTimestamps();
    }

    public function secondaryUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'commission_rule_secondary_user')
            ->withTimestamps();
    }
}
