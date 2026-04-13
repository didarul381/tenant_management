<?php

namespace App\Repositories;

use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalaryRepository extends BaseRepository
{
    public function getFieldsSearchable()
    {
        return ['id', 'user_id', 'basic_salary', 'house_rent', 'ta_da', 'medical_allowance', 'over_time', 'leave_penalty', 'absent_penalty', 'attendece_penalty', 'other_penalty', 'tax', 'payable', 'paid', 'due', 'year', 'month'];
    }

    public function model()
    {
        return Salary::class;
    }

    public function getSalaryList($request)
    {
        $query = Salary::selectRaw('
                year,
                month,
                SUM(payable) as total_payable, 
                SUM(paid) as total_paid, 
                SUM(due) as total_due,
                COUNT(id) as employee_count
            ')
            ->groupBy(['year', 'month']);

        if (!empty($request->get('year'))) {
            $query->where('year', $request->get('year'));
        }

        if (!empty($request->get('month'))) {
            $query->where('month', $request->get('month'));
        }

        if (!empty($request->get('user_id'))) {
            $query->where('user_id', $request->get('user_id'));
        }

        return $query->orderBy('year', 'desc')
                    ->orderBy('month', 'desc')
                    ->get();
    }

    public function getSalaryDetails($salary)
    {
        return [
            'Basic Salary' => $salary->basic_salary,
            'House Rent' => $salary->house_rent,
            'TA/DA' => $salary->ta_da,
            'Medical Allowance' => $salary->medical_allowance,
            'Over Time' => $salary->over_time,
            'Leave Penalty' => $salary->leave_penalty,
            'Absent Penalty' => $salary->absent_penalty,
            'Attendence Penalty' => $salary->attendece_penalty,
            'Other Penalty' => $salary->other_penalty,
            'Other Penalty Note' => $salary->other_penalty_note,
            'Tax' => $salary->tax,
            'Payable' => $salary->payable,
            'Paid' => $salary->paid,
            'Due' => $salary->due,
        ];
    }

    public function create($input)
    {
        $salary = Salary::create($input);
        return $salary;
    }

    public function update($input, $id)
    {
        $salary = Salary::find($id);
        $salary->update($input);
        return $salary;
    }
}
