<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeadFollowUp extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'lead_follow_ups'; // Make sure your table name matches
    protected $casts = [
        'follow_up_at' => 'datetime',
    ];

    protected $fillable = [
        'lead_id',
        'assigned_to',
        'follow_up_at',
        'type',      // call, email, meeting, sms, other
        'status',    // pending, completed, cancelled, etc.
        'note',
        'created_by',
        'updated_by',
    ];

    // Relationships
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
