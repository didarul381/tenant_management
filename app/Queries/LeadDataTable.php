<?php

namespace App\Queries;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Builder;

class LeadDataTable
{
    public function get(array $input = []): Builder
{
    $query = Lead::with(['user', 'leadStage', 'source','assignedUser'])->select('leads.*');

    if (!empty($input['filter_stage'])) {
        $query->where('stage_id', $input['filter_stage']);
    }

    if (!empty($input['filter_source'])) {
        $query->where('source_id', $input['filter_source']);
    }

    if (!empty($input['filter_user'])) {
        $query->where('created_by', $input['filter_user']);
    }

    if (!empty($input['date_range'])) {
        [$start, $end] = explode(' - ', $input['date_range']);
        $query->whereBetween('created_at', [
            $start . ' 00:00:00',
            $end . ' 23:59:59'
        ]);
    }

    if (!empty($input['follow_up_date'])) {
       [$start, $end] = explode(' - ', $input['follow_up_date']);
       $query->whereHas('followUps', function ($q) use ($start, $end) {
           $q->whereBetween('follow_up_at', [
               $start . ' 00:00:00',
               $end . ' 23:59:59'
           ]);
       });
    }



    return $query;
}

}
