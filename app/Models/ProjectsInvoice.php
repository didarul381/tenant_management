<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProjectsInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'projects_invoice';

    protected $fillable = [
        'client_id',
        'project_id',
        'status',
        'created_by',
        'deleted_by',
        'price',
        'paid',
        'due',
        'invoice',
        'in_word',
        'for',
    ];

    protected $casts = [
        'client_id' => 'integer',
        'project_id' => 'integer',
        'created_by' => 'integer',
        'deleted_by' => 'integer',
        'price' => 'integer',
        'paid' => 'integer',
        'due' => 'integer',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    public static $statusOptions = [
        self::STATUS_PENDING,
        self::STATUS_APPROVED,
        self::STATUS_REJECTED,
    ];

    public static function generateUniqueInvoiceOld(): string
    {
        do {
            $code = 'PINV-'.date('Ymd').'-'.Str::upper(Str::random(6));
        } while (self::where('invoice', $code)->exists());

        return $code;
    }

    public static function generateUniqueInvoice(): string
    {
        return DB::transaction(function () {
            $date = date('Ymd');
            $prefix = 'STR-' . $date . '-';

            // Lock table range to avoid two requests generating same next number
            // (works best with InnoDB; still add UNIQUE(invoice) for guarantee)
            $lastInvoice = self::withTrashed()
                ->where('invoice', 'like', 'STR-%')   // global sequence (not per-day)
                ->orderBy('invoice', 'desc')
                ->lockForUpdate()
                ->value('invoice');

            $nextNumber = 1;

            if ($lastInvoice) {
                // last 6 digits after final "-"
                $lastNumber = (int) substr($lastInvoice, -6);
                $nextNumber = $lastNumber + 1;
            }

            return $prefix . str_pad((string) $nextNumber, 6, '0', STR_PAD_LEFT);
        });
    }


    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function createdUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function deletedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
