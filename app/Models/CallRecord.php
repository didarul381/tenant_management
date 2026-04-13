<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'display_name',
        'call_date',
        'source',
        'destination',
        'duration',
        'type',
        'status',
        'recordings',
        'employee_name',
    ];

    protected $dates = ['call_date'];
}
