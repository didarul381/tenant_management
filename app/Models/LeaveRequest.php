<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'leave_requests';

    protected $fillable = [
        'user_id',
        'partial_leave',   // yes/no or 0/1
        'from_date',
        'to_date',
        'total_days',
        'from_time',
        'to_time',
        'reason',
        'status',
        'created_by',
        'deleted_by',
        'swap_date',
    ];

    protected $casts = [
        'user_id'       => 'integer',
        'partial_leave' => 'boolean',
        'from_date'     => 'date',
        'to_date'       => 'date',
        'total_days'    => 'integer',
        'from_time'     => 'string',
        'to_time'       => 'string',
        'reason'        => 'string',
        'status'        => 'string',
        'created_by'    => 'integer',
        'deleted_by'    => 'integer',
        'swap_date'     => 'date',
    ];

    public static $rules = [
        'user_id'       => 'required|exists:users,id',
        'partial_leave' => 'nullable|boolean',
        'from_date'     => 'required|date',
        'to_date'       => 'required|date|after_or_equal:from_date',
        'total_days'    => 'required|integer|min:1',
        'from_time'     => 'nullable|date_format:H:i',
        'to_time'       => 'nullable|date_format:H:i|after:from_time',
        'reason'        => 'required|string|max:1000',
        'status'        => 'nullable|in:pending,approved,rejected,swap',
    ];

    // Define statuses
    public const STATUSES = [
        'pending'   => 'Pending',
        'approved'  => 'Approved',
        'rejected'  => 'Rejected',
        'swap'      => 'Swap',
    ];


    // 🔹 Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function attachments()
    {
        return $this->hasMany(LeaveRequestAttachment::class);
    }
}
