<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;


    const PER_PAGE_OPTION = [
        10 => '10',
        25 => '25',
        50 => '50',
        100 => '100',
    ];
    const LEAD_FILTER_OPTION = [
        'all' => 'All Leads',
        'my_leads' => 'My Leads',
        'unassigned' => 'Unassigned Leads',
    ];  
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'source_id',
        'stage_id',
        'assigned_to',
        'job_title',
        'industry',
        'company',
        'website',
        'linkedin',
        'instagram',
        'facebook',
        'pinterest',
        'city',
        'state',
        'zip',
        'country',
        'description',
        'created_by',
        'deleted_by',
    ];

    // Validation rules
    public static $rules = [
        'first_name'   => 'required|string|max:255',
        'last_name'    => 'nullable|string|max:255',
        'email'        => 'nullable|email|max:255',
        'phone'        => 'nullable|string|max:50',
        'source_id'    => 'nullable|exists:lead_sources,id',
        'stage_id'     => 'nullable|exists:lead_stages,id',
        'assigned_to'  => 'nullable|exists:users,id',
        'job_title'    => 'nullable|string|max:255',
        'industry'     => 'nullable|string|max:255',
        'company'      => 'nullable|string|max:255',
        'website'      => 'nullable|url|max:255',
        'linkedin'     => 'nullable|url|max:255',
        'instagram'    => 'nullable|url|max:255',
        'facebook'     => 'nullable|url|max:255',
        'pinterest'    => 'nullable|url|max:255',
        'city'         => 'nullable|string|max:255',
        'state'        => 'nullable|string|max:255',
        'zip'          => 'nullable|string|max:50',
        'country'      => 'nullable|string|max:255',
        'description'  => 'nullable|string',
    ];

    // Relationships
    public function source()
    {
        return $this->belongsTo(LeadSource::class, 'source_id');
    }

    public function leadStage()
    {
        return $this->belongsTo(LeadStage::class, 'stage_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function followUps()
    {
        return $this->hasMany(LeadFollowUp::class, 'lead_id');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
