<?php

namespace App\Repositories;

use App\Models\Lead;
use App\Models\LeadStage;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class LeadRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'job_title',
        'industry',
        'city',
        'state',
        'country',
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
        return Lead::class;
    }

    /**
     * Store a newly created Lead.
     *
     * @param array $input
     * @return Lead
     */
    public function store($input)
    {
        $input['created_by'] = getLoggedInUserId();
        $input['deleted_by'] = null;

        // default empty values for optional fields
        $input['job_title']  = $input['job_title'] ?? '';
        $input['industry']   = $input['industry'] ?? '';
        $input['company']    = $input['company'] ?? '';
        $input['website']    = $input['website'] ?? '';
        $input['linkedin']   = $input['linkedin'] ?? '';
        $input['instagram']  = $input['instagram'] ?? '';
        $input['facebook']   = $input['facebook'] ?? '';
        $input['pinterest']  = $input['pinterest'] ?? '';
        $input['city']       = $input['city'] ?? '';
        $input['state']      = $input['state'] ?? '';
        $input['zip']        = $input['zip'] ?? '';
        $input['country']    = $input['country'] ?? '';

        $lead = Lead::create($input);

        return $lead->fresh();
    }

    /**
     * Update an existing Lead.
     *
     * @param array $input
     * @param int $id
     * @return Lead
     */
    public function update($input, $id)
    {
        $lead = Lead::find($id);

        if (!$lead) {
            throw new UnprocessableEntityHttpException('Lead not found');
        }

        $input['job_title']  = $input['job_title'] ?? '';
        $input['industry']   = $input['industry'] ?? '';
        $input['company']    = $input['company'] ?? '';
        $input['website']    = $input['website'] ?? '';
        $input['linkedin']   = $input['linkedin'] ?? '';
        $input['instagram']  = $input['instagram'] ?? '';
        $input['facebook']   = $input['facebook'] ?? '';
        $input['pinterest']  = $input['pinterest'] ?? '';
        $input['city']       = $input['city'] ?? '';
        $input['state']      = $input['state'] ?? '';
        $input['zip']        = $input['zip'] ?? '';
        $input['country']    = $input['country'] ?? '';

        $lead->update($input);

        return $lead->fresh();
    }

    /**
     * Delete a Lead.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id)
    {
        $lead = Lead::find($id);

        if (!$lead) {
            throw new UnprocessableEntityHttpException('Lead not found');
        }

        $lead->update(['deleted_by' => getLoggedInUserId()]);
        return $lead->delete();
    }

    public function getLeadData()
    {
        /** @var UserRepository $userRepo */
        $userRepo = app(UserRepository::class);
        $data['users'] = $userRepo->getUserList();

        // return all users who have manage_leads permission otherwise only logged in user
        if (getLoggedInUser()->hasPermissionTo('manage_leads')) {
            $data['assignees'] = $data['users'];
        } else {
            $data['assignees'] = $data['users']->only(getLoggedInUserId());
        }

        /** @var LeadSourceRepository $sourceRepo */
        $sourceRepo = app(LeadSourceRepository::class);
        $data['sources'] = $sourceRepo->getSourceList();

        /** @var LeadStageRepository $stageRepo */
        $stageRepo = app(LeadStageRepository::class);
        $data['stages'] = $stageRepo->getStageList();

        // Leads grouped by stage (for kanban columns)
        $data['leads'] = $this->getLeadList();

        $data['perPageOption'] = Lead::PER_PAGE_OPTION;
        $data['leadsFilterOptions'] = Lead::LEAD_FILTER_OPTION;

        return $data;
    }

    public function getLeadList()
    {
        return Lead::with(['followUps','assignedUser', 'source', 'leadStage'])
            ->orderBy('stage_id')
            ->get()
            ->groupBy('stage_id');
    }

}
