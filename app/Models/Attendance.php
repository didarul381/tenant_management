<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'signing_in_date_time',
        'signing_out_date_time',
        'status',
        'duration',
        'note',
        'office_time',
        'deleted_by',
    ];

    protected $casts = [
        'signing_in_date_time' => 'datetime',
        'signing_out_date_time' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function getDurationInHoursAttribute()
    {
        if (!$this->signing_in_date_time || !$this->signing_out_date_time) {
            return null;
        }

        $start = $this->signing_in_date_time;
        $end = $this->signing_out_date_time;
        
        return $end->diffInMinutes($start) / 60;
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('signing_in_date_time', [$startDate, $endDate]);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('signing_in_date_time', now()->toDateString());
    }

    public function isSignedIn()
    {
        return !is_null($this->signing_in_date_time) && is_null($this->signing_out_date_time);
    }

    public function isSignedOut()
    {
        return !is_null($this->signing_in_date_time) && !is_null($this->signing_out_date_time);
    }
}
