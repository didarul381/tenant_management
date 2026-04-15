<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'properties';

    protected $fillable = [
        'name',
        'owner_id', // Assuming owner is a User
        'address',
        'total_floors',
        'total_units',
        'description',
        'status',
        'created_by',
        'deleted_by',
    ];

    protected $casts = [
        'owner_id'     => 'integer',
        'total_floors' => 'integer',
        'total_units'  => 'integer',
        'created_by'   => 'integer',
        'deleted_by'   => 'integer',
    ];

    public static $rules = [
        'name'         => 'required|string|max:255',
        'owner_id'     => 'required|exists:users,id',
        'address'      => 'required|string|max:500',
        'total_floors' => 'required|integer|min:1',
        'total_units'  => 'required|integer|min:1',
        'description'  => 'nullable|string|max:1000',
        'status'       => 'required|in:active,inactive,sold',
    ];

    public const STATUSES = [
        'active'   => 'Active',
        'inactive' => 'Inactive',
        'sold'     => 'Sold',
    ];

    // 🔹 Relationships
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attachments()
    {
        return $this->hasMany(PropertyDocument::class);
    }

    
}