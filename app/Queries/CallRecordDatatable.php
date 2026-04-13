<?php

namespace App\Queries;

use App\Models\CallRecord;
use Illuminate\Database\Eloquent\Builder;

class CallRecordDatatable
{
    /**
     * Get query for DataTable with filters.
     *
     * @param array $input
     * @return Builder
     */
    public function get(array $input = []): Builder
    {
        $query = CallRecord::query();

        // Filter by employee name
        if (!empty($input['filter_employee_name'])) {
            $query->where('employee_name', $input['filter_employee_name']);
        }

        // Filter by status
        if (!empty($input['filter_status'])) {
            $query->where('status', $input['filter_status']);
        }

        // Filter by call date range
        if (!empty($input['filter_call_date'])) {
            [$start, $end] = explode(' - ', $input['filter_call_date']);
            $query->whereBetween('call_date', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        // Filter by created date range
        if (!empty($input['filter_created_at'])) {
            [$start, $end] = explode(' - ', $input['filter_created_at']);
            $query->whereBetween('created_at', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        return $query;
    }

    public function summary(array $input = [])
    {
        $query = $this->get($input); // reuse existing filtered query
    
        // Count by status
        $summary = $query->selectRaw('status, COUNT(*) as count')
                         ->groupBy('status')
                         ->pluck('count', 'status');
    
        // Unique numbers
        $uniqueNumbers = $query->distinct('source')->count('source');
        $totalCalls = $summary->sum();
    
        return [
            'summary' => $summary,
            'uniqueNumbers' => $uniqueNumbers,
             'totalCalls' => $totalCalls,
        ];
    }

}
