<?php

namespace App\Queries;

use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;

class PropertyDatatable
{
    /**
     * Get query for Property DataTable.
     *
     * @param array $input
     * @return Builder
     */
    public function get(array $input = []): Builder
    {
        // Eager load owner and property type for better performance
        $query = Property::with(['owner'])->select('properties.*');

        // Filter by Owner
        if (!empty($input['filter_owner'])) {
            $query->where('owner_id', $input['filter_owner']);
        }

        // Filter by Property Type (e.g., Apartment, Commercial, Villa)
        if (!empty($input['filter_type'])) {
            $query->where('property_type_id', $input['filter_type']);
        }

        // Filter by Status (e.g., Active, Inactive, Maintenance)
        if (!empty($input['filter_status']) && $input['filter_status'] !== 'all') {
            $query->where('status', $input['filter_status']);
        }

        // Filter by Rent Range
        if (!empty($input['min_rent'])) {
            $query->where('rent_amount', '>=', $input['min_rent']);
        }
        if (!empty($input['max_rent'])) {
            $query->where('rent_amount', '<=', $input['max_rent']);
        }

        // Filter by Date Created (useful for "Recently Added" listings)
        if (!empty($input['date_range'])) {
            [$start, $end] = explode(' - ', $input['date_range']);
            $query->whereBetween('created_at', [
                $start . ' 00:00:00',
                $end . ' 23:59:59'
            ]);
        }

        return $query->orderBy('created_at', 'desc');
    }
}