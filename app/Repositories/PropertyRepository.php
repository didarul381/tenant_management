<?php

namespace App\Repositories;

use App\Models\Property;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class PropertyRepository extends BaseRepository
{
    /**
     * Fields that can be searched via the API/Controller.
     */
    protected $fieldSearchable = [
        'name',
        'property_type_id',
        'address',
        'city',
        'rent_amount',
        'security_deposit',
        'status', // active, inactive, maintenance
        'owner_id',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return Property::class;
    }

    /**
     * Store a newly created Property.
     *
     * @param array $input
     * @return Property
     */
    public function store($input)
    {
        $input['created_by'] = getLoggedInUserId();
        $input['deleted_by'] = null;
        
        // Default status to active if not provided
        $input['status'] = $input['status'] ?? 'active';

        $property = Property::create($input);

        return $property->fresh();
    }

    /**
     * Update a Property.
     *
     * @param array $input
     * @param int $id
     * @return Property
     */
    public function update($input, $id)
    {
        $property = Property::find($id);

        if (!$property) {
            throw new UnprocessableEntityHttpException('Property not found');
        }

        $property->update($input);

        return $property->fresh();
    }

    /**
     * Delete a Property (soft delete with deleted_by).
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id)
    {
        $property = Property::find($id);

        if (!$property) {
            throw new UnprocessableEntityHttpException('Property not found');
        }

        // Track who deleted the record before soft-deleting
        $property->update(['deleted_by' => getLoggedInUserId()]);

        return $property->delete();
    }

    /**
     * Get Properties list by specific owner.
     *
     * @param int $ownerId
     * @return \Illuminate\Support\Collection
     */
    public function getOwnerPropertyList($ownerId)
    {
        return Property::where('owner_id', $ownerId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}