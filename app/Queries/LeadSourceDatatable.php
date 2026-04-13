<?php

namespace App\Queries;

use App\Models\LeadSource;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LeadSourceDatatable.
 */
class LeadSourceDatatable
{
    /**
     * @return Builder
     */
    public function get()
    {
        $q = LeadSource::with(['user'])->select('lead_sources.*');

        return $q;
    }
}
