<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'job_types';

    protected $fillable = [
        'name',
        'color',
        'description',
        'order',
        'created_by',
        'deleted_by',
    ];

    protected $casts = [
        'order' => 'integer',
        'created_by' => 'integer',
        'deleted_by' => 'integer',
    ];

    /**
     * Get the jobs that have this type.
     */
   
    public function projects()
    {
        return $this->hasMany(Project::class, 'job_type', 'id');
    }

    /**
     * Get the user who created this type.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who deleted this type.
     */
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}