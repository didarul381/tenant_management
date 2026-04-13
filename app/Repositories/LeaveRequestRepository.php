<?php

namespace App\Repositories;

use App\Models\LeaveRequest;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class LeaveRequestRepository extends BaseRepository
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
        return LeaveRequest::class;
    }

    /**
     * Store a newly created LeaveRequest.
     *
     * @param array $input
     * @return LeaveRequest
     */
    public function store($input)
    {
        $input['created_by'] = getLoggedInUserId();
        $input['deleted_by'] = null;
        $input['status']     = $input['status'] ?? 'pending';

        $leave = LeaveRequest::create($input);

        return $leave->fresh();
    }

    /**
     * Update a LeaveRequest.
     *
     * @param array $input
     * @param int $id
     * @return LeaveRequest
     */
    public function update($input, $id)
    {
        $leave = LeaveRequest::find($id);

        if (!$leave) {
            throw new UnprocessableEntityHttpException('Leave Request not found');
        }

        $leave->update($input);

        return $leave->fresh();
    }

    /**
     * Delete a LeaveRequest (soft delete with deleted_by).
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id)
    {
        $leave = LeaveRequest::find($id);

        if (!$leave) {
            throw new UnprocessableEntityHttpException('Leave Request not found');
        }

        $leave->update(['deleted_by' => getLoggedInUserId()]);

        return $leave->delete();
    }

    /**
     * Get Leave Requests list by user
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    public function getUserLeaveList($userId)
    {
        return LeaveRequest::where('user_id', $userId)
            ->orderBy('from_date', 'desc')
            ->get();
    }
}
