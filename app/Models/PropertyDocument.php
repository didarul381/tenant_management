<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PropertyDocument extends Model
{
    use HasFactory, ImageTrait;

    const PATH = 'property_documents';

    public $table = 'property_documents';

    protected $appends = ['file_url'];

    public $fillable = [
        'property_id',
        'file',
        'document_type', // e.g., 'Land Deed'
    ];

    protected $casts = [
        'property_id' => 'integer',
        'file'        => 'string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * @return string
     */
    public function getFilePathAttribute()
    {
        return self::PATH . '/' . $this->property_id . '/' . $this->file;
    }

    /**
     * @return string
     */
    public function getFileUrlAttribute()
    {
        return Storage::url($this->getFilePathAttribute());
    }
}