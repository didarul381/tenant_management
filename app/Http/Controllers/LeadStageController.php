<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLeadStageRequest;
use App\Models\LeadStage;
use App\Queries\LeadStageDatatable;
use App\Repositories\LeadStageRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class LeadStageController extends AppBaseController
{
    /** @var LeadStageRepository */
    private $leadStageRepository;

    public function __construct(LeadStageRepository $leadStageRepo)
    {
        $this->leadStageRepository = $leadStageRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Response|JsonResponse
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new LeadStageDatatable())->get())->make(true);
        }

        return view('lead_stages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('lead_stages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLeadStageRequest  $request
     * @return Response
     */
    public function store(CreateLeadStageRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = getLoggedInUserId();

        $this->leadStageRepository->create($input);

        Flash::success('Lead Stage added successfully.');

        return redirect(route('lead-stages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  LeadStage  $leadStage
     * @return Response
     */
    public function show(LeadStage $leadStage)
    {
        return view('lead_stages.show', compact('leadStage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LeadStage  $leadStage
     * @return Response
     */
    public function edit(LeadStage $leadStage)
    {
        return view('lead_stages.edit', compact('leadStage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateLeadStageRequest  $request
     * @param  LeadStage  $leadStage
     * @return Response
     */
    public function update(CreateLeadStageRequest $request, LeadStage $leadStage)
    {
        $input = $request->all();

        $this->leadStageRepository->update($input, $leadStage->id);

        Flash::success('Lead Stage updated successfully.');

        return redirect(route('lead-stages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LeadStage  $leadStage
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(LeadStage $leadStage)
    {
        $leadStage->update(['deleted_by' => getLoggedInUserId()]);
        $leadStage->delete();

        return $this->sendSuccess('Lead Stage deleted successfully.');
    }
}
