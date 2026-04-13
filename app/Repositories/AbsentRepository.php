<?php

namespace App\Repositories;

use App\Models\Absent;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AbsentRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'partial_leave',
        'from_date',
        'to_date',
        'total_days',
        'from_time',
        'to_time',
        'reason',
        'status',
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
        return Absent::class;
    }

    /**
     * Store a newly created Absent.
     *
     * @param array $input
     * @return Absent
     */
    public function store($input)
    {
        $input['created_by'] = getLoggedInUserId();
        $input['deleted_by'] = null;
        $input['status']     = $input['status'] ?? 'pending';

        $absent = Absent::create($input);

        return $absent->fresh();
    }

    /**
     * Update an Absent.
     *
     * @param array $input
     * @param int $id
     * @return Absent
     */
    public function update($input, $id)
    {
        $absent = Absent::find($id);

        if (!$absent) {
            throw new UnprocessableEntityHttpException('Absent not found');
        }

        $absent->update($input);

        return $absent->fresh();
    }

    /**
     * Delete an Absent (soft delete with deleted_by).
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id)
    {
        $absent = Absent::find($id);

        if (!$absent) {
            throw new UnprocessableEntityHttpException('Absent not found');
        }

        $absent->update(['deleted_by' => getLoggedInUserId()]);

        return $absent->delete();
    }

    /**
     * Get Absent list by user
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    public function getUserAbsentList($userId)
    {
        return Absent::where('user_id', $userId)
            ->orderBy('from_date', 'desc')
            ->get();
    }
}
