<?php

namespace App\Queries;

use App\Models\LeaveRequest;
use Illuminate\Database\Eloquent\Builder;

class LeaveRequestDatatable
{
    /**
     * Get query for DataTable.
     *
     * @param array $input
     * @return Builder
     */
    public function get(array $input = []): Builder
    {
        $query = LeaveRequest::with(['user'])->select('leave_requests.*');

        // Filter by user
        if (!empty($input['filter_user'])) {
            $query->where('user_id', $input['filter_user']);
        }

        // Filter by status
        if (!empty($input['filter_status'])) {
            $query->where('status', $input['filter_status']);
        }

        // Filter by date range
        if (!empty($input['date_range'])) {
            [$start, $end] = explode(' - ', $input['date_range']);
            $query->whereBetween('from_date', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        return $query;
    }
}
