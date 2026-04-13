<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateAbsentRequest;
use App\Http\Requests\UpdateAbsentRequest;
use App\Models\Absent;
use App\Models\User;
use App\Queries\AbsentDatatable;
use App\Repositories\AbsentRepository;
use DataTables;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Models\UserNotification;

class AbsentController extends AppBaseController
{
    /** @var AbsentRepository */
    private $absentRepository;

    public function __construct(AbsentRepository $absentRepo)
    {
        $this->absentRepository = $absentRepo;
    }

    /**
     * Display a listing of Absents.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request)
    {
       
        $isAdmin = auth()->user()->hasRole('Admin');
        if ($isAdmin) {
            // Admin can see all Absent
              if ($request->ajax()) {
                return DataTables::of((new AbsentDatatable())->get($request->only([
                    'filter_user',
                    'filter_status',
                    'date_range',
                    'search',
                ])))
                    ->editColumn('user.name', function (Absent $absent) {
                        return $absent->user ? $absent->user->name : 'N/A';
                    })
                     ->editColumn('status', function (Absent $absent) {
                        $status = $absent->status;
                        $badgeClass = $status == 'approved' ? 'badge-success' : ($status == 'rejected' ? 'badge-danger' : 'badge-warning');
                        return '<span class="badge ' . $badgeClass . '">' . ucfirst($status) . '</span>';
                    })
                    ->editColumn('reason', function (Absent $absent) {
                            $reason = $absent->reason ?? '';
                            if (strlen($reason) > 100) {
                                $truncated = substr($reason, 0, 100) . '...';
                                return '<div class="reason-container">
                                    <span class="reason-short">' . htmlspecialchars($truncated) . '</span>
                                    <span class="reason-full" style="display:none;">' . htmlspecialchars($reason) . '</span>
                                    <button class="btn btn-link btn-sm show-more-reason">Show more</button>
                                    <button class="btn btn-link btn-sm show-less-reason" style="display:none;">Close</button>
                                </div>';
                            } else {
                                return htmlspecialchars($reason);
                            }
                     })
                    ->editColumn('created_at', function (Absent $absent) {
                            return $absent->created_at ? $absent->created_at->format('M j, Y') : 'N/A';
                     })
                    ->addColumn('absent_day', function (Absent $absent) {
                            $from = $absent->from_date ? Carbon::parse($absent->from_date) : null;
                            $to = $absent->to_date ? Carbon::parse($absent->to_date) : null;
                            if (!$from || !$to) {
                                return 'N/A';
                            }
                            if ($from->equalTo($to)) {
                                return $from->format('M j, Y');
                            } elseif ($from->year == $to->year) {
                                return $from->format('M j') . ' – ' . $to->format('M j, Y');
                            } else {
                                return $from->format('M j, Y') . ' – ' . $to->format('M j, Y');
                            }
                     })
                     ->addColumn('action', function (Absent $absent) {
                        $approve = '<a class="btn btn-sm btn-success approve-btn mb-1" data-id="' . $absent->id . '" title="Approve" value="approved"><i class="fas fa-check" style="font-size:15px;"></i></a>';
                        $reject = '<a class="btn btn-sm btn-danger reject-btn mb-1" data-id="' . $absent->id . '" title="Reject" value="rejected"><i class="fas fa-times" style="font-size:15px;"></i></a>';
                        $pending = '<a class="btn btn-sm btn-warning pending-btn mb-1" data-id="' . $absent->id . '" title="Pending Status" value="pending"><i class="fas fa-clock" style="font-size:15px;"></i></a>';
                        $view = '<a href="' . route('absents.show', $absent->id) . '" class="btn btn-sm btn-info view-btn mb-1" title="View"><i class="fas fa-eye"></i></a>';
                        $edit = '<a href="' . route('absents.edit', $absent->id) . '" class="btn btn-sm btn-primary edit-btn mb-1" title="Edit"><i class="fas fa-edit"></i></a>';
                        $delete = '<a href="#" data-id="' . $absent->id . '" class="btn btn-sm btn-danger delete-btn mb-1" title="Delete"><i class="fas fa-trash"></i></a>';

                        return $approve . ' ' . $reject . ' ' . $pending . ' ' . $view . ' ' . $edit . ' ' . $delete;
                    })
                    ->filterColumn('user.name', function (Builder $query, $search) {
                        $query->whereHas('user', function (Builder $q) use ($search) {
                            $q->where('name', 'like', "%$search%");
                        });
                    })
                    ->rawColumns(['status', 'action', 'reason'])
                    ->make(true);
            }
        } else {
            // Users can only see their Absent
            if ($request->ajax()) {
                return DataTables::of((new AbsentDatatable())->get($request->only([
                    'filter_user',
                    'filter_status',
                    'date_range',
                    'search',
                ]))
                ->where('user_id', auth()->id())) // Filter by authenticated user
                    ->editColumn('user.name', function (Absent $absent) {
                        return $absent->user ? $absent->user->name : 'N/A';
                    })
                    ->editColumn('status', function (Absent $absent) {
                        $status = $absent->status;
                        $badgeClass = $status == 'approved' ? 'badge-success' : ($status == 'rejected' ? 'badge-danger' : 'badge-warning');
                        return '<span class="badge ' . $badgeClass . '">' . ucfirst($status) . '</span>';
                    })
                    ->editColumn('reason', function (Absent $absent) {
                        $reason = $absent->reason ?? '';
                        if (strlen($reason) > 100) {
                            $truncated = substr($reason, 0, 100) . '...';
                            return '<div class="reason-container">
                                <span class="reason-short">' . htmlspecialchars($truncated) . '</span>
                                <span class="reason-full" style="display:none;">' . htmlspecialchars($reason) . '</span>
                                <button class="btn btn-link btn-sm show-more-reason">Show more</button>
                                <button class="btn btn-link btn-sm show-less-reason" style="display:none;">Close</button>
                            </div>';
                        } else {
                            return htmlspecialchars($reason);
                        }
                    })
                    ->editColumn('created_at', function (Absent $absent) {
                        return $absent->created_at ? $absent->created_at->format('M j, Y') : 'N/A';
                    })
                    ->addColumn('absent_day', function (Absent $absent) {
                        $from = $absent->from_date ? Carbon::parse($absent->from_date) : null;
                        $to = $absent->to_date ? Carbon::parse($absent->to_date) : null;
                        if (!$from || !$to) {
                            return 'N/A';
                        }
                        if ($from->equalTo($to)) {
                            return $from->format('M j, Y');
                        } elseif ($from->year == $to->year) {
                            return $from->format('M j') . ' – ' . $to->format('M j, Y');
                        } else {
                            return $from->format('M j, Y') . ' – ' . $to->format('M j, Y');
                        }
                    })
                    ->addColumn('action', function (Absent $absent) {
                        $view = '<a href="' . route('absents.show', $absent->id) . '" class="btn btn-sm btn-info view-btn" title="View"><i class="fas fa-eye"></i></a>';
                        return $view;
                    })
                    ->filterColumn('user.name', function (Builder $query, $search) {
                        $query->whereHas('user', function (Builder $q) use ($search) {
                            $q->where('name', 'like', "%$search%");
                        });
                    })
                    ->rawColumns(['status', 'action', 'reason'])
                    ->make(true);
            }
        }

        $currentUser = auth()->user();
        if (auth()->user()->hasRole('Admin')) {
           $users = User::pluck('name', 'id');
        }else {
            $users = User::where('id', $currentUser->id)
                        ->pluck('name', 'id');
        }
       
        $statuses = Absent::STATUSES; // ['pending','approved','rejected']

        return view('absents.index', compact('users', 'statuses'));
    }

    /**
     * Show the form for creating a new Absent.
     *
     * @return View
     */
    public function create()
    {  
         if (auth()->user()->hasRole('Admin')) {
           $users = User::pluck('name', 'id');
           $statuses = Absent::STATUSES;

          return view('absents.create', compact('users', 'statuses'));
         }else{
              Flash::error('You Are Not Authorized To Create Absent');
             return redirect()->route('absents.index');
         }  
        
    }

    /**
     * Store a newly created Absent.
     *
     * @param CreateAbsentRequest $request
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(CreateAbsentRequest $request)
    {
      

        if (auth()->user()->hasRole('Admin')) {
              $input = $request->all();
        $input['user_id'] = $input['user_id'] ?? auth()->id();
        $input['created_by'] = getLoggedInUserId();

        $absent= $this->absentRepository->create($input);
        if ($request->status == 'approved') {
            $description = 'An Approved Absent has been created for you by Admin';
        } elseif ($request->status == 'rejected') {
            $description = 'An Rejected Absent has been created for you by Admin';
        } else {
            $description = 'An Absent has been created for you by Admin';
        }
        
        
        UserNotification::create([
                'title' => 'Absent Created',
                'description' => $description,
                'link' => url('/absents/' . $absent->id),
                'type' => Absent::class,
                'user_id' => $input['user_id'],
        ]);

        Flash::success('Absent created successfully.');
          return redirect(route('absents.index'));
            
        } else {
            Flash::error('You are not authorized to create Absent');
            return redirect()->back()->withInput();
        }
      

      
    }

    /**
     * Display the specified Absent.
     *
     * @param Absent $absent
     * @return View
     */
    public function show(Absent $absent)
    {  
         $isAdmin = auth()->user()->hasRole('Admin');
        if (!$isAdmin && $absent->user_id !== auth()->id()) {
            Flash::error('You Are Not Authorized To View Other Absent Details');
            return redirect()->route('absents.index');
        }
        return view('absents.show', compact('absent'));
    }

    /**
     * Show the form for editing the specified Absent.
     *
     * @param Absent $absent
     * @return View
     */
    public function edit(Absent $absent)
    {
        $isAdmin = auth()->user()->hasRole('Admin');
        if (!$isAdmin) {
            Flash::error('You Are Not Authorized To Edit Absent Details');
           return redirect()->route('absents.index');
        }
        $users = User::pluck('name', 'id');
        $statuses = Absent::STATUSES;

        return view('absents.edit', compact('absent', 'users', 'statuses'));
    }

    /**
     * Update the specified Absent.
     *
     * @param CreateAbsentRequest $request
     * @param Absent $absent
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(CreateAbsentRequest $request, Absent $absent)
    {
        
        $isAdmin = auth()->user()->hasRole('Admin');
        if (!$isAdmin) {
          Flash::error('You Are Not Authorized To Update Absent Details');
           return redirect()->route('absents.index');
        }

        $this->absentRepository->update($request->all(), $absent->id);
          $statusText = ucfirst($request->status);

                UserNotification::create([
                    'title' => 'Absent ' . $statusText,
                    'description' => 'Your absent has been Updated and status is ' . $statusText,
                    'link' => url('/absents/' . $absent->id),
                    'type' => Absent::class,
                    'user_id' => $absent->user_id,
                ]);

        Flash::success('Absent updated successfully.');

        return redirect(route('absents.index'));
    }

    /**
     * Delete the specified Absent.
     *
     * @param Absent $absent
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Absent $absent)
    {
         $isAdmin = auth()->user()->hasRole('Admin');
        if (!$isAdmin) {
           Flash::error('You Are Not Authorized To Delete Other Absent Details');
           return redirect()->route('absents.index');
        }
        $absent->update(['deleted_by' => getLoggedInUserId()]);
        $absent->delete();

        return $this->sendSuccess('Absent deleted successfully.');
    }

     public function updateStatus(Request $request, Absent $absent)
    {
        $isAdmin = auth()->user()->hasRole('Admin');
        if (!$isAdmin) {
           Flash::error('You Are Not Authorized To Update Other Absent Status');
           return redirect()->route('absents.index');
        }
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $absent->update(['status' => $request->status]);

        $statusText = ucfirst($request->status);

        UserNotification::create([
            'title' => 'Absent ' . $statusText,
            'description' => 'Your absent has been ' . $statusText,
            'link' => url('/absents/' . $absent->id),
            'type' => Absent::class,
            'user_id' => $absent->user_id,
        ]);

        return $this->sendSuccess('Absent status updated successfully.');
    }

}
