<?php

namespace App\Queries;

use App\Models\Tag;
use Illuminate\Database\Query\Builder;

/**
 * Class TagDataTable.
 */
class TagDataTable
{
    /**
     * @param  array  $input
     * @return Tag|Builder
     */
    public function get($input = [])
    {
        /** @var Tag $query */
        $query = Tag::query();

        $departmentFilter = $input['department_filter'] ?? 'all';
        $statusFilter = $input['status_filter'] ?? 'all';

        if ($departmentFilter === 'non_departmental') {
            $query->whereDoesntHave('departments');
        } elseif ($departmentFilter !== 'all' && is_numeric($departmentFilter)) {
            $query->whereHas('departments', function ($q) use ($departmentFilter) {
                $q->where('departments.id', $departmentFilter);
            });
        }

        if ($statusFilter !== 'all') {
            $query->where('is_active', $statusFilter);
        }

        return $query;
    }
}
