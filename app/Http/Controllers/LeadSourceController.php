<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLeadSourceRequest;
use App\Http\Requests\UpdateLeadSourceRequest;
use App\Models\LeadSource;
use App\Queries\LeadSourceDatatable;
use App\Repositories\LeadSourceRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class LeadSourceController extends AppBaseController
{
    /** @var LeadSourceRepository */
    private $leadSourceRepository;

    public function __construct(LeadSourceRepository $leadSourceRepo)
    {
        $this->leadSourceRepository = $leadSourceRepo;
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
            return DataTables::of((new LeadSourceDatatable())->get())->make(true);
        }

        return view('lead_sources.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('lead_sources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLeadSourceRequest  $request
     * @return Response
     */
    public function store(CreateLeadSourceRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = getLoggedInUserId();

        $this->leadSourceRepository->create($input);

        Flash::success('Lead Source added successfully.');

        return redirect(route('lead-sources.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  LeadSource  $leadSource
     * @return Response
     */
    public function show(LeadSource $leadSource)
    {
        return view('lead_sources.show', compact('leadSource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LeadSource  $leadSource
     * @return Response
     */
    public function edit(LeadSource $leadSource)
    {
        return view('lead_sources.edit', compact('leadSource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLeadSourceRequest  $request
     * @param  LeadSource  $leadSource
     * @return Response
     */
    public function update(CreateLeadSourceRequest $request, LeadSource $leadSource)
    {
        $input = $request->all();

        $this->leadSourceRepository->update($input, $leadSource->id);

        Flash::success('Lead Source updated successfully.');

        return redirect(route('lead-sources.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LeadSource  $leadSource
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(LeadSource $leadSource)
    {
        $leadSource->update(['deleted_by' => getLoggedInUserId()]);
        $leadSource->delete();

        return $this->sendSuccess('Lead Source deleted successfully.');
    }
}
