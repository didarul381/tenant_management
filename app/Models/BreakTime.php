<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BreakTime extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'breaks';

    protected $fillable = [
        'user_id',
        'break_start_time',
        'break_back_time',
        'duration',
        'description',
        'deleted_by',
    ];

    protected $casts = [
        'break_start_time' => 'datetime',
        'break_back_time' => 'datetime',
        'duration' => 'integer',
        'user_id' => 'integer',
        'deleted_by' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('break_back_time');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('break_start_time', now()->toDateString());
    }

    public function getDurationAttribute($value)
    {
        if ($this->break_start_time && $this->break_back_time) {
            return $this->break_start_time->diffInSeconds($this->break_back_time);
        }
        return $value;
    }

    public function getFormattedDurationAttribute()
    {
        $duration = $this->duration;
        if ($duration) {
            if ($duration < 60) {
                return $duration . 's'; // Show seconds for breaks less than 1 minute
            }
            $hours = floor($duration / 3600);
            $minutes = floor(($duration % 3600) / 60);
            $seconds = $duration % 60;
            
            if ($hours > 0) {
                return $hours . 'h ' . $minutes . 'm ' . $seconds . 's';
            } elseif ($minutes > 0) {
                return $minutes . 'm ' . $seconds . 's';
            } else {
                return $seconds . 's';
            }
        }
        return '-';
    }
}
