<?php

namespace App\Repositories;

use App\Models\LeadSource;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class LeadSourceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
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
     * Specify the model class name
     *
     * @return string
     */
    public function model()
    {
        return LeadSource::class;
    }

    /**
     * Store a newly created LeadSource
     *
     * @param array $input
     * @return LeadSource
     */
    public function store($input)
    {
        $input['description'] = $input['description'] ?? '';
        $input['created_by'] = getLoggedInUserId();
        $input['deleted_by'] = null;

        $leadSource = LeadSource::create($input);

        return $leadSource->fresh();
    }

    /**
     * Update a LeadSource
     *
     * @param array $input
     * @param int $id
     * @return LeadSource
     */
    public function update($input, $id)
    {
        $leadSource = LeadSource::find($id);

        if (!$leadSource) {
            throw new UnprocessableEntityHttpException('Lead Source not found');
        }

        $input['description'] = $input['description'] ?? '';

        $leadSource->update($input);

        return $leadSource->fresh();
    }

    /**
     * Delete a LeadSource
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id)
    {
        $leadSource = LeadSource::find($id);

        if (!$leadSource) {
            throw new UnprocessableEntityHttpException('Lead Source not found');
        }

        $leadSource->update(['deleted_by' => getLoggedInUserId()]);
        return $leadSource->delete();
    }

    public function getSourceList()
    {
        return LeadSource::orderBy('name', 'asc')
            ->pluck('name', 'id');
    }
}
