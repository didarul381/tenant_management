<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

/**
 * App\Models\LeaveRequestAttachment.
 *
 * @property int                             $id
 * @property int                             $leave_request_id
 * @property string|null                     $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $file_path
 * @property-read mixed $file_url
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LeaveRequestAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LeaveRequestAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LeaveRequestAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LeaveRequestAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LeaveRequestAttachment whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LeaveRequestAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LeaveRequestAttachment whereLeaveRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LeaveRequestAttachment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LeaveRequestAttachment extends Model
{
    use HasFactory;
    use ImageTrait;

    const PATH = 'leave_request_attachments';

    public $table = 'leave_request_attachments';

    protected $appends = ['file_url'];

    public $fillable = [
        'leave_request_id',
        'file',
    ];

    protected $casts = [
        'leave_request_id' => 'integer',
        'file' => 'string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leaveRequest()
    {
        return $this->belongsTo(LeaveRequest::class);
    }

    /**
     * @return string
     */
    public function getFilePathAttribute()
    {
        return self::PATH . '/' . $this->leave_request_id . '/' . $this->file;
    }

    /**
     * @return string
     */
    public function getFileUrlAttribute()
    {
        return Storage::url($this->getFilePathAttribute());
    }
}
