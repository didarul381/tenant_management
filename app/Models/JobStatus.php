<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'job_statuses';

    protected $fillable = [
        'name',
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
     * Get the jobs that have this status.
     */
   
    public function projects()
    {
        return $this->hasMany(Project::class, 'status', 'id');
    }

    /**
     * Get the user who created this status.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who deleted this status.
     */
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}