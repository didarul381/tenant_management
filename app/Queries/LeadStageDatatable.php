<?php

namespace App\Queries;

use App\Models\LeadStage;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LeadStageDatatable.
 */
class LeadStageDatatable
{
    /**
     * Get query for datatable.
     *
     * @return Builder
     */
    public function get(): Builder
    {
        $query = LeadStage::with(['user'])->select('lead_stages.*');

        return $query;
    }
}
