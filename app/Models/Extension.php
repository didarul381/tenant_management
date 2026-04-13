<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'source','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static $rules = [
        'user_id' => 'required|exists:users,id',
        //'source'  => 'required|unique:extensions,source',
        'source'  => 'required',
        'status'  => 'required|in:Active,Inactive',
    ];
}
