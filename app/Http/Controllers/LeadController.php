<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\LeadStage;
use App\Models\User;
use App\Queries\LeadDataTable;
use App\Repositories\LeadRepository;
use DataTables;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

/**
 * Class LeadController.
 */
class LeadController extends AppBaseController
{
    /** @var LeadRepository */
    private $leadRepository;

    public function __construct(LeadRepository $leadRepo)
    {
        $this->leadRepository = $leadRepo;
    }

    /**
     * Display a listing of the Leads.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request)
    {
        //dd($request);
        //exit;
        if ($request->ajax()) {
            return DataTables::of((new LeadDataTable())->get($request->only([
                'filter_stage',
                'filter_source',
                'filter_user',
                'date_range',
                'follow_up_date', // <— new param
                'search',
            ])))
               ->editColumn('checkbox', function (Lead $lead) {
                      return '<input type="checkbox" class="lead-checkbox" value="'.$lead->id.'">';
                })
                ->editColumn('name', function (Lead $lead) {
                    $website = $lead->website 
                        ? '<a href="' . (preg_match("~^(?:f|ht)tps?://~i", $lead->website) ? $lead->website : 'http://' . $lead->website) . '" target="_blank">' 
                            . $lead->website . 
                        '</a>' 
                        : '';

                    return $lead->first_name . ' ' . $lead->last_name . '<br>' 
                        . $lead->email . '<br>' 
                        . $website;
                })
                ->editColumn('source.name', function (Lead $lead) {
                    return $lead->source ? $lead->source->name : 'N/A';
                })
                ->editColumn('leadStage.name', function (Lead $lead) {
                    $stages = LeadStage::pluck('name', 'id')->toArray();
                    $currentStageId = $lead->leadStage ? $lead->leadStage->id : null;
                    $currentStage   = $lead->leadStage ? $lead->leadStage->name : null;

                    // Define stage colors
                    $colors = [
                        'New'       => ['bg' => '#0d6efd', 'text' => 'white'],   // primary
                        'Contacted' => ['bg' => '#0dcaf0', 'text' => 'white'],   // info
                        'Qualified' => ['bg' => '#ffc107', 'text' => 'black'],   // warning
                        'Won'       => ['bg' => '#198754', 'text' => 'white'],   // success
                        'Lost'      => ['bg' => '#dc3545', 'text' => 'white'],   // danger
                    ];

                    $bg       = $colors[$currentStage]['bg'] ?? '#6c757d';  // fallback secondary
                    $text     = $colors[$currentStage]['text'] ?? 'white';

                    $options = '';
                    foreach ($stages as $id => $stage) {
                        $selected = $currentStageId == $id ? 'selected' : '';
                        $options .= "<option value='{$id}' {$selected}>{$stage}</option>";
                    }

                    return "
                        <select class='form-control form-select form-select-sm lead-stage-dropdown'
                                data-lead-id='{$lead->id}'
                                style='background-color: {$bg}; color: {$text};'>
                            {$options}
                        </select>
                    ";
                })

                ->editColumn('assignedUser.name', function (Lead $lead) {
                    return $lead->assignedUser ? $lead->assignedUser->name : 'N/A';
                })
                ->editColumn('phone', function (Lead $lead) {
                    // return '<a href="sip:' . $lead->phone . '@103.125.255.222:3080">
                    //             ' . $lead->phone . ' <i style="font-size: 20px;"  class="fa fa-phone-square" aria-hidden="true"></i>
                    //         </a>';
                     // Phone link
                     $phoneHtml = '<a href="sip:' . $lead->phone . '@103.125.255.222:3080">
                                     ' . $lead->phone . ' 
                                     <i style="font-size: 20px;" class="fa fa-phone-square" aria-hidden="true"></i>
                                   </a>';
                 
                     // FollowUps (latest first)
                     $followUps = $lead->followUps()
                         ->where('status', '!=', 'completed') // complete বাদে
                         ->orderBy('follow_up_at', 'asc')
                         ->get();
                 
                     $followUpCount = $followUps->count();
                     $latestFollowUp = $followUps->first(); // সর্বশেষ follow up
                 
                     // Latest status + date দেখাতে চাইলে:
                     $latestStatus = $latestFollowUp ? ucfirst($latestFollowUp->status) : 'No FollowUp';
                     $latestDate   = $latestFollowUp ? $latestFollowUp->follow_up_at->format('M d, Y') : '';
                 
                     // Combine phone + followup info
                     $html = $phoneHtml;
                     if ($followUpCount > 0) {
                         $html .= '<br><span class="badge bg-warning text-white">FollowUps: ' . $followUpCount . '</span>';
                     }
                     if ($latestFollowUp) {
                         $html .= '<br><small class="text-info">Next FollowUp: ' . $latestStatus . ' (' . $latestDate . ')</small>';
                     }
                 
                     return $html;
                })


                ->rawColumns(['phone','name', 'leadStage.name'])
                ->filterColumn('name', function (Builder $query, $search) {
                    $query->where(function (Builder $query) use ($search) {
                        $query->where('first_name', 'like', "%$search%")
                              ->orWhere('last_name', 'like', "%$search%");
                    });
                })
                ->make(true);
        }

        $stages  = LeadStage::pluck('name', 'id');
        $sources = LeadSource::pluck('name', 'id');
        $users   = User::pluck('name', 'id');

        return view('leads.index', compact('stages', 'sources', 'users'));
    }

    /**
     * Show the form for creating a new Lead.
     *
     * @return View
     */
    public function create()
    {
        $stages  = LeadStage::pluck('name', 'id');
        $sources = LeadSource::pluck('name', 'id');
        $users   = User::pluck('name', 'id');

        return view('leads.create', compact('stages', 'sources', 'users'));
    }

    /**
     * Store a newly created Lead in storage.
     *
     * @param CreateLeadRequest $request
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(CreateLeadRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = getLoggedInUserId();

        $this->leadRepository->create($input);

        Flash::success('Lead created successfully.');

        return redirect(route('leads.index'));
    }

    /**
     * Display the specified Lead.
     *
     * @param Lead $lead
     * @return View
     */
    public function show(Lead $lead)
    {
        // Eager load related models to optimize queries
        $lead->load([
            'user',           
            'assignedUser',   
            'source',         
            'leadStage',          
            'followUps.assignedUser' 
        ]);
        $users = User::pluck('name', 'id'); 

        return view('leads.show', compact('lead','users'));
    }


    /**
     * Show the form for editing the specified Lead.
     *
     * @param Lead $lead
     * @return View
     */
    public function edit(Lead $lead)
    {
        $stages  = LeadStage::pluck('name', 'id');
        $sources = LeadSource::pluck('name', 'id');
        $users   = User::pluck('name', 'id');

        return view('leads.edit', compact('lead', 'stages', 'sources', 'users'));
    }

    /**
     * Update the specified Lead in storage.
     *
     * @param CreateLeadRequest $request
     * @param Lead $lead
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(CreateLeadRequest $request, Lead $lead)
    {
        $this->leadRepository->update($request->all(), $lead->id);

        Flash::success('Lead updated successfully.');

        return redirect(route('leads.index'));
    }

    /**
     * Remove the specified Lead from storage.
     *
     * @param Lead $lead
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Lead $lead)
    {
        $lead->update(['deleted_by' => getLoggedInUserId()]);
        $lead->delete();

        return $this->sendSuccess('Lead deleted successfully.');
    }

    /**
     * Update lead assignment.
     *
     * @param Lead $lead
     * @param Request $request
     * @return JsonResponse
     */
    public function assignUser(Lead $lead, Request $request)
    {
        $lead->update(['assigned_to' => $request->get('user_id')]);

        return $this->sendSuccess('Lead assigned successfully.');
    }

    public function getKanbanLeads()
    {
        $data = $this->leadRepository->getLeadData();

        return view('leads.kanban', $data);
    }

    public function updateStage(Request $request, Lead $lead)
    {
        $lead->update([
            'stage_id' => $request->new_stage,
        ]);

        return response()->json(['success' => true, 'message' => 'Lead stage updated successfully']);
    }

    public function bulkAssign(Request $request)
    {
        $request->validate([
            'lead_ids' => 'required|array',
            'assigned_to' => 'required|exists:users,id',
        ]);
    
        Lead::whereIn('id', $request->lead_ids)
            ->update(['assigned_to' => $request->assigned_to]);
    
        return response()->json(['success' => true, 'message' => 'Leads have been assigned successfully']);
    }


    public function updateStageFromListing(Request $request, Lead $lead)
    {
        $request->validate([
            'stage_id' => 'required|exists:lead_stages,id',
        ]);

        $lead->stage_id  = $request->stage_id;
        $lead->save();

        return response()->json([
            'success' => true,
            'message' => 'Lead stage updated successfully.',
        ]);
    }

    // LeadController.php
    public function followUps(Request $request, Lead $lead)
    {
        // return $lead;
        if ($request->ajax()) {
            $lead->load(['followUps.assignedUser']); // eager load assigned user
    
          $html = '';

          if ($lead->followUps->count() > 0) {
              $html .= "<div class='table-responsive'>
                          <table class='table table-striped table-bordered table-hover'>
                              <thead class='table-light'>
                                  <tr>
                                      <th>Follow-up On</th>
                                      <th>Assigned To</th>
                                      <th>Status</th>
                                      <th>Created At</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>";
              
              foreach ($lead->followUps as $followUp) {
                  $assignedUser = $followUp->assignedUser->name ?? 'N/A';
                  $followUpAt = \Carbon\Carbon::parse($followUp->follow_up_at)->format('M d, Y h:i A');
                  $createdAt = \Carbon\Carbon::parse($followUp->created_at)->format('M d, Y h:i A');
                  $status = ucfirst($followUp->status);
          
                  $html .= "
                      <tr id='followUpRow{$followUp->id}'>
                          <td>{$followUpAt}</td>
                          <td>{$assignedUser}</td>
                          <td>{$status}</td>
                          <td>{$createdAt}</td>
                          <td>
                            <button class='btn editFollowUpBtn bg-h' data-id='{$followUp->id}'>
                                    <i class='fas fa-edit card-edit-icon'></i>
                            </button>
                            <button class='btn followup-delete-btn bg-h' data-id='{$followUp->id}'>
                                <i class='fas fa-trash card-delete-icon'></i>
                            </button>
                              
                          </td>
                      </tr>
                  ";
              }
          
              $html .= "</tbody></table></div>";
          } else {
              //$html = "<div class='text-center text-muted my-2'>No follow-ups found.</div>";
              $html='';
          }
          
          return response()->json(['html' => $html]);
        }
    }






}
