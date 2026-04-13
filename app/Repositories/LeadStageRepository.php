<?php

namespace App\Repositories;

use App\Models\LeadStage;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class LeadStageRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'sort_order',
        'color',
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
        return LeadStage::class;
    }

    /**
     * Store a newly created LeadStage.
     *
     * @param array $input
     * @return LeadStage
     */
    public function store($input)
    {
        $input['description'] = $input['description'] ?? '';
        $input['created_by'] = getLoggedInUserId();
        $input['deleted_by'] = null;

        $leadStage = LeadStage::create($input);

        return $leadStage->fresh();
    }

    /**
     * Update a LeadStage.
     *
     * @param array $input
     * @param int $id
     * @return LeadStage
     */
    public function update($input, $id)
    {
        $leadStage = LeadStage::find($id);

        if (!$leadStage) {
            throw new UnprocessableEntityHttpException('Lead Stage not found');
        }

        $input['description'] = $input['description'] ?? '';

        $leadStage->update($input);

        return $leadStage->fresh();
    }

    /**
     * Delete a LeadStage.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id)
    {
        $leadStage = LeadStage::find($id);

        if (!$leadStage) {
            throw new UnprocessableEntityHttpException('Lead Stage not found');
        }

        $leadStage->update(['deleted_by' => getLoggedInUserId()]);
        return $leadStage->delete();
    }

    public function getStageList()
    {
        return LeadStage::orderBy('sort_order', 'asc')
            ->pluck('name', 'id');
    }
}
