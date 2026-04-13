<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'salaries';

    protected $fillable = [
        'user_id',
        'basic_salary',
        'house_rent',
        'ta_da',
        'medical_allowance',
        'over_time',
        'commission',
        'eid_bonus',
        'leave_penalty',
        'absent_penalty',
        'attendece_penalty',
        'other_penalty',
        'other_penalty_note',
        'tax',
        'payable',
        'paid',
        'due',
        'year',
        'month',
        'created_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'basic_salary' => 'decimal:2',
        'house_rent' => 'decimal:2',
        'ta_da' => 'decimal:2',
        'medical_allowance' => 'decimal:2',
        'over_time' => 'decimal:2',
        'commission' => 'decimal:2',
        'eid_bonus' => 'decimal:2',
        'leave_penalty' => 'decimal:2',
        'absent_penalty' => 'decimal:2',
        'attendece_penalty' => 'decimal:2',
        'other_penalty' => 'decimal:2',
        'tax' => 'decimal:2',
        'payable' => 'decimal:2',
        'paid' => 'decimal:2',
        'due' => 'decimal:2',
        'year' => 'integer',
        'month' => 'integer',
        'created_by' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getFormattedBasicSalaryAttribute()
    {
        return number_format($this->basic_salary, 2);
    }

    public function getFormattedHouseRentAttribute()
    {
        return number_format($this->house_rent, 2);
    }

    public function getFormattedTaDaAttribute()
    {
        return number_format($this->ta_da, 2);
    }

    public function getFormattedMedicalAllowanceAttribute()
    {
        return number_format($this->medical_allowance, 2);
    }

    public function getFormattedOverTimeAttribute()
    {
        return number_format($this->over_time, 2);
    }

     public function getFormattedCommissionAttribute()
    {
        return number_format($this->commission, 2);
    }

     public function getFormattedEidBonusAttribute()
    {
        return number_format($this->eid_bonus, 2);
    }

    public function getFormattedLeavePenaltyAttribute()
    {
        return number_format($this->leave_penalty, 2);
    }

    public function getFormattedAbsentPenaltyAttribute()
    {
        return number_format($this->absent_penalty, 2);
    }

     public function getFormattedAttendencePenaltyAttribute()
        {
            return number_format($this->attendece_penalty, 2);
        }

    public function getFormattedOtherPenaltyAttribute()
    {
        return number_format($this->other_penalty, 2);
    }

    public function getFormattedTaxAttribute()
    {
        return number_format($this->tax, 2);
    }

    public function getFormattedPayableAttribute()
    {
        return number_format($this->payable, 2);
    }

    public function getFormattedPaidAttribute()
    {
        return number_format($this->paid, 2);
    }

    public function getFormattedDueAttribute()
    {
        return number_format($this->due, 2);
    }

    public function getMonthYearAttribute()
    {
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        return ($months[$this->month] ?? '') . ' ' . $this->year;
    }
}
