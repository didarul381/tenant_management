<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\UserNotification;
use App\Queries\LeaveRequestDatatable;
use App\Repositories\LeaveRequestRepository;
use DataTables;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Models\LeaveRequestAttachment;
use Illuminate\Support\Facades\Log;
class LeaveRequestController extends AppBaseController
{
    /** @var LeaveRequestRepository */
    private $leaveRequestRepository;

    public function __construct(LeaveRequestRepository $leaveRepo)
    {
        $this->leaveRequestRepository = $leaveRepo;
    }

    /**
     * Display a listing of Leave Requests.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request)
    {

        $isAdmin = auth()->user()->hasRole('Admin');
        if ($isAdmin) {
            // Admin can see all leave requests
            if ($request->ajax()) {
                return DataTables::of((new LeaveRequestDatatable())->get($request->only([
                    'filter_user',
                    'filter_status',
                    'date_range',
                    'search',
                ])))
                    ->editColumn('user.name', function (LeaveRequest $leave) {
                        return $leave->user ? $leave->user->name : 'N/A';
                    })
                    ->editColumn('status', function (LeaveRequest $leave) {
                                    $status = $leave->status;
                                    $displayText = $status;
                                    $badgeClass = '';

                                    if ($status == 'approved') {
                                        $badgeClass = 'badge-success';
                                        $displayText = 'Approved';
                                    } elseif ($status == 'rejected') {
                                        $badgeClass = 'badge-danger';
                                        $displayText = 'Rejected';
                                    } elseif ($status == 'pending') {
                                        $badgeClass = 'badge-info';
                                        $displayText = 'Pending';
                                    } elseif ($status == 'swap') {
                                        $badgeClass = 'badge-warning';
                                        $displayText = 'Swapped';
                                    }

                        return '<span class="badge ' . $badgeClass . '">' . $displayText . '</span>';
                    })
                    ->editColumn('reason', function (LeaveRequest $leave) {
                        $reason = $leave->reason ?? '';
                        if (mb_strlen($reason, 'UTF-8') > 100) {
                            $truncated = mb_substr($reason, 0, 100, 'UTF-8') . '...';
                            return '<div class="reason-container">
                                <span class="reason-short">' . htmlspecialchars($truncated) . '</span>
                                <span class="reason-full" style="display:none;">' . htmlspecialchars($reason) . '</span>
                                <button class="btn btn-link btn-sm show-more-reason reason-btn-bold">Show more</button>
                                <button class="btn btn-link btn-sm show-less-reason reason-btn-bold" style="display:none;"><strong>Close</strong></button>
                            </div>';
                        } else {
                            return htmlspecialchars($reason);
                        }
                    })
                    ->editColumn('created_at', function (LeaveRequest $leave) {
                        return $leave->created_at ? $leave->created_at->format('M j, Y') : 'N/A';
                    })
                    ->addColumn('leave_day', function (LeaveRequest $leave) {
                        $from = $leave->from_date ? Carbon::parse($leave->from_date) : null;
                        $to = $leave->to_date ? Carbon::parse($leave->to_date) : null;
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
                    ->addColumn('action', function (LeaveRequest $leave) {
                        $approve = '<a class="btn btn-sm btn-success approve-btn" data-id="' . $leave->id . '" title="Approve" value="approved"><i class="fas fa-check" style="font-size:15px;"></i></a>';
                        $reject = '<a class="btn btn-sm btn-danger reject-btn" data-id="' . $leave->id . '" title="Reject" value="rejected"><i class="fas fa-times" style="font-size:15px;"></i></a>';
                        $swap = '<a class="btn btn-sm btn-warning swap-btn" data-id="' . $leave->id . '" title="Swap Status" value="swap"><i class="fas fa-exchange-alt" style="font-size:15px;"></i></a>';
                        $view = '<a href="' . route('leave-requests.show', $leave->id) . '" class="btn btn-sm btn-info view-btn" title="View"><i class="fas fa-eye"></i></a>';
                        $edit = '<a href="' . route('leave-requests.edit', $leave->id) . '" class="btn btn-sm btn-primary edit-btn" title="Edit"><i class="fas fa-edit"></i></a>';
                        $delete = '<a href="#" data-id="' . $leave->id . '" class="btn btn-sm btn-danger delete-btn" title="Delete"><i class="fas fa-trash"></i></a>';

                        return $approve . ' ' . $reject . ' ' . $swap . ' ' . $view . ' ' . $edit . ' ' . $delete;
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
            // Non-admin users can only see their own leave requests
            if ($request->ajax()) {
                return DataTables::of((new LeaveRequestDatatable())->get($request->only([
                    'filter_user',
                    'filter_status',
                    'date_range',
                    'search',
                ]))
                ->where('user_id', auth()->id())) // Filter by authenticated user
                    ->editColumn('user.name', function (LeaveRequest $leave) {
                        return $leave->user ? $leave->user->name : 'N/A';
                    })
                    ->editColumn('status', function (LeaveRequest $leave) {
                                    $status = $leave->status;
                                    $displayText = $status;
                                    $badgeClass = '';

                                    if ($status == 'approved') {
                                        $badgeClass = 'badge-success';
                                        $displayText = 'Approved';
                                    } elseif ($status == 'rejected') {
                                        $badgeClass = 'badge-danger';
                                        $displayText = 'Rejected';
                                    } elseif ($status == 'pending') {
                                        $badgeClass = 'badge-info';
                                        $displayText = 'Pending';
                                    } elseif ($status == 'swap') {
                                        $badgeClass = 'badge-warning';
                                        $displayText = 'Swapped';
                                    }

                        return '<span class="badge ' . $badgeClass . '">' . $displayText . '</span>';
                    })
                    ->editColumn('reason', function (LeaveRequest $leave) {
                        $reason = $leave->reason ?? '';
                        if (mb_strlen($reason, 'UTF-8') > 100) {
                            $truncated = mb_substr($reason, 0, 100, 'UTF-8') . '...';
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
                    ->editColumn('created_at', function (LeaveRequest $leave) {
                        return $leave->created_at ? $leave->created_at->format('M j, Y') : 'N/A';
                    })
                    ->addColumn('leave_day', function (LeaveRequest $leave) {
                        $from = $leave->from_date ? Carbon::parse($leave->from_date) : null;
                        $to = $leave->to_date ? Carbon::parse($leave->to_date) : null;
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
                    ->addColumn('action', function (LeaveRequest $leave) {
                        $view = '<a href="' . route('leave-requests.show', $leave->id) . '" class="btn btn-sm btn-info view-btn" title="View"><i class="fas fa-eye"></i></a>';

                        if ($leave->status === 'pending') {
                            $edit = '<a href="' . route('leave-requests.edit', $leave->id) . '" class="btn btn-sm btn-primary edit-btn" title="Edit"><i class="fas fa-edit"></i></a>';
                            $delete = '<a href="#" data-id="' . $leave->id . '" class="btn btn-sm btn-danger delete-btn" title="Delete"><i class="fas fa-trash"></i></a>';
                            return $view . ' ' . $edit . ' ' . $delete;
                        } else {
                            return $view;
                        }
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
        $statuses = LeaveRequest::STATUSES; // e.g. ['pending', 'approved', 'rejected']

        $currentYear = date('Y');
        $userRole = auth()->user()->role;

        if ($userRole === 'Admin') {
            $totalUsers = User::where('role', '!=', 'Admin')->count();
            $totalPossible = $totalUsers * 12;
            $approvedDays = LeaveRequest::where('status', 'approved')
                ->whereYear('from_date', $currentYear)
                ->sum('total_days');
            $swappedDays = LeaveRequest::where('status', 'swap')
                ->whereYear('from_date', $currentYear)
                ->sum('total_days');
            $remaining = $totalPossible - $approvedDays;
            $totalRequests = LeaveRequest::whereYear('from_date', $currentYear)->count();
            $stats = [
                'total' => $totalRequests,
                'approved' => $approvedDays,
                'remaining' => $remaining,
                'swapped' => $swappedDays,
            ];
        } else {
            $approvedDays = LeaveRequest::where('user_id', auth()->id())
                ->where('status', 'approved')
                ->whereYear('from_date', $currentYear)
                ->sum('total_days');

            $swappedDays = LeaveRequest::where('user_id', auth()->id())
                ->where('status', 'swap')
                ->whereYear('from_date', $currentYear)
                ->sum('total_days');

            $remaining = 12 - $approvedDays;
            $totalRequests = LeaveRequest::where('user_id', auth()->id())
                ->whereYear('from_date', $currentYear)
                ->count();
            $stats = [
                'total' => $totalRequests,
                'approved' => $approvedDays,
                'remaining' => $remaining,
                'swapped' => $swappedDays,
            ];
        }





        return view('leave_requests.index', compact('users', 'statuses', 'stats'));
    }

    /**
     * Show the form for creating a new Leave Request.
     *
     * @return View
     */
    public function create()
    {

         $userRole = auth()->user()->role;
         $users = User::pluck('name', 'id');
         $statuses = LeaveRequest::STATUSES;

        return view('leave_requests.create', compact('users', 'statuses', 'userRole'));
    }

    /**
     * Store a newly created Leave Request.
     *
     * @param CreateLeaveRequest $request
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(CreateLeaveRequest $request)
    {
        if($request->partial_leave ==1 || auth()->user()->hasRole('Admin')){

            $input = $request->all();
            $input['user_id'] = $input['user_id'] ?? auth()->id();
            $input['created_by'] = getLoggedInUserId();

            $leaveRequest= $this->leaveRequestRepository->create($input);

            // Handle file attachments for admin path
            if ($request->hasFile('files')) {
                //\Log::info('Files found in request: ' . count($request->file('files')));
                foreach ($request->file('files') as $file) {
                    if ($file->isValid()) {
                        $fileName = $file->getClientOriginalName();
                       // \Log::info('Processing file: ' . $fileName);

                        $filePath = LeaveRequestAttachment::PATH . '/' . $leaveRequest->id;
                        //\Log::info('Storing to: ' . $filePath);

                        $file->storeAs($filePath, $fileName, 'public');

                        $attachment = LeaveRequestAttachment::create([
                            'leave_request_id' => $leaveRequest->id,
                            'file' => $fileName,
                        ]);
                       // \Log::info('Attachment created with ID: ' . $attachment->id);
                    } else {
                        //\Log::error('File is not valid');
                    }
                }
            } else {
               // \Log::info('No files found in leave request');
            }

            UserNotification::create([
                'title' => 'Leave Request Created',
                'description' => 'A leave request has been created for you by Admin',
                'link' => url('/leave-requests/' . $leaveRequest->id),
                'type' => LeaveRequest::class,
                'user_id' => $input['user_id'],
            ]);

            Flash::success('Leave request created successfully.');


        }else{
            $input = $request->all();
            $userId = $input['user_id'] ?? auth()->id();
            $totalDays = $input['total_days'];
            $fromDate = $input['from_date'];
            $currentYear = date('Y', strtotime($fromDate));

            // Check total approved leave days for the user in the current year
            $approvedLeaveDays = LeaveRequest::where('user_id', $userId)
                ->where('status', 'approved')
                ->whereYear('from_date', $currentYear)
                ->sum('total_days');

            // if ($totalDays > 12) {
            //         Flash::error('You Are Not Allowed To Create Leave Request More Than 12 Days Please Contract To Super Admin');

            //         return redirect()->back()->withInput();
            //  }

            if ($approvedLeaveDays + $totalDays > 12) {
                Flash::error('You have already taken ' . $approvedLeaveDays . ' approved leave days this year. You can only take up to 12 days total.');

                return redirect()->back()->withInput();
            }




            $input['user_id'] = $userId;
            $input['created_by'] = getLoggedInUserId();

            $leaveRequest = $this->leaveRequestRepository->create($input);

            // Handle file attachments
            if ($request->hasFile('files')) {
               // \Log::info('Files found in non-admin request: ' . count($request->file('files')));
                foreach ($request->file('files') as $file) {
                    if ($file->isValid()) {
                        $fileName = $file->getClientOriginalName();
                       // \Log::info('Processing file in non-admin path: ' . $fileName);

                        $filePath = LeaveRequestAttachment::PATH . '/' . $leaveRequest->id;
                       // \Log::info('Storing to: ' . $filePath);

                        $file->storeAs($filePath, $fileName, 'public');

                        $attachment = LeaveRequestAttachment::create([
                            'leave_request_id' => $leaveRequest->id,
                            'file' => $fileName,
                        ]);
                        //\Log::info('Attachment created with ID: ' . $attachment->id);
                    } else {
                        //\Log::error('File is not valid in non-admin path');
                    }
                }
            } else {
               // \Log::info('No files found in non-admin request');
            }

            // Check if this is AJAX request
            if ($request->ajax()) {
                return response()->json(['redirect_url' => route('leave-requests.index')]);
            }
            $admins = User::role('Admin')->get();

            foreach ($admins as $admin) {
                UserNotification::create([
                    'title' => 'New Leave Request',
                    'description' => auth()->user()->name . ' has submitted a leave request',
                    'link' => url('/leave-requests/' . $leaveRequest->id),
                    'type' => LeaveRequest::class,
                    'user_id' => $admin->id,
                ]);
            }
            Flash::success('Leave request created successfully.');
        }



        return redirect(route('leave-requests.index'));
    }

    /**
     * Display the specified Leave Request.
     *
     * @param LeaveRequest $leaveRequest
     * @return View
     */
    public function show($leaveRequest)
    {
        $leaveRequest = LeaveRequest::withTrashed()->findOrFail($leaveRequest);

        $isAdmin = auth()->user()->hasRole('Admin');
        if (!$isAdmin && $leaveRequest->user_id !== auth()->id()) {
            Flash::error('You Are Not Authorized To View Other Leave Request');
            return redirect()->route('leave-requests.index');
        }
        return view('leave_requests.show', compact('leaveRequest'));
    }

    /**
     * Show the form for editing the specified Leave Request.
     *
     * @param LeaveRequest $leaveRequest
     * @return View
     */
    public function edit(LeaveRequest $leaveRequest)
    {
        $isAdmin = auth()->user()->hasRole('Admin');
        if (!$isAdmin && $leaveRequest->user_id !== auth()->id()) {
            Flash::error('You Are Not Authorized To Edit Other Leave Request');
            return redirect()->route('leave-requests.index');
        }


        if(auth()->user()->hasRole('Admin')){
              $users = User::pluck('name', 'id');
            $statuses = LeaveRequest::STATUSES;

        }else{
                // If the current request is approved,rejected,swap can not edit
                if ($leaveRequest->status === 'approved' || $leaveRequest->status === 'rejected' ||     $leaveRequest->status === 'swap')
                     {
                    Flash::error($leaveRequest->status . ' Leave Requests Cannot Be Edited.');
                    return redirect()->back();
                }else{
                    $users = User::where('id', auth()->id())->pluck('name', 'id');
                    $statuses = LeaveRequest::STATUSES;
                }


        }


        return view('leave_requests.edit', compact('leaveRequest', 'users', 'statuses'));
    }

    /**
     * Update the specified Leave Request.
     *
     * @param UpdateLeaveRequest $request
     * @param LeaveRequest $leaveRequest
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(CreateLeaveRequest $request, LeaveRequest $leaveRequest)
    {
        if($request->partial_leave ==1 || auth()->user()->hasRole('Admin')){
              $this->leaveRequestRepository->update($request->all(), $leaveRequest->id);

              // Handle file attachments for update
              if ($request->hasFile('files')) {
                 // \Log::info('Files found in update request: ' . count($request->file('files')));
                  foreach ($request->file('files') as $file) {
                      if ($file->isValid()) {
                          $fileName = $file->getClientOriginalName();
                          //\Log::info('Processing file in update: ' . $fileName);

                          $filePath = LeaveRequestAttachment::PATH . '/' . $leaveRequest->id;
                          //\Log::info('Storing to: ' . $filePath);

                          $file->storeAs($filePath, $fileName, 'public');

                          $attachment = LeaveRequestAttachment::create([
                              'leave_request_id' => $leaveRequest->id,
                              'file' => $fileName,
                          ]);
                          //\Log::info('Attachment created with ID: ' . $attachment->id);
                      } else {
                          //\Log::error('File is not valid in update');
                      }
                  }
              } else {
                  //\Log::info('No files found in update leave request');
              }

               $statusText = ucfirst($request->status);

                UserNotification::create([
                    'title' => 'Leave Request ' . $statusText,
                    'description' => 'Leave Request Has Been Updated Status Is ' . $statusText,
                    'link' => url('/leave-requests/' . $leaveRequest->id),
                    'type' => LeaveRequest::class,
                    'user_id' => $leaveRequest->user_id,
                ]);

             Flash::success('Leave request updated successfully.');

            // return redirect(route('leave-requests.index'));

        }else{
             $input = $request->all();
                $userId = $leaveRequest->user_id;
                $totalDays = $input['total_days'];
                $fromDate = $input['from_date'];
                $currentYear = date('Y', strtotime($fromDate));

                // Check total approved leave days for the user in the current year
                $approvedLeaveDays = LeaveRequest::where('user_id', $userId)
                    ->where('status', 'approved')
                    ->whereYear('from_date', $currentYear)
                    ->sum('total_days');

                // If the current request is approved subtract its old total_days
                // if ($leaveRequest->status == 'approved') {
                //     $approvedLeaveDays -= $leaveRequest->total_days;
                // }

                // if ($totalDays > 12) {
                //     Flash::error('You Can Not Modify Leave Request More Than 12 Days Please Contract To Super Admin');

                //     return redirect()->back()->withInput();
                // }

                if ($approvedLeaveDays + $totalDays > 12) {
                    Flash::error('Already taken ' . $approvedLeaveDays . ' approved leave days this year. You can only take up to 12 days total.');

                    return redirect()->back()->withInput();
                }


                $this->leaveRequestRepository->update($input, $leaveRequest->id);

            // Handle file attachments for non-admin update
            if ($request->hasFile('files')) {
                //\Log::info('Files found in non-admin update request: ' . count($request->file('files')));
                foreach ($request->file('files') as $file) {
                    if ($file->isValid()) {
                        $fileName = $file->getClientOriginalName();
                        //\Log::info('Processing file in non-admin update: ' . $fileName);

                        $filePath = LeaveRequestAttachment::PATH . '/' . $leaveRequest->id;
                        //\Log::info('Storing to: ' . $filePath);

                        $file->storeAs($filePath, $fileName, 'public');

                        $attachment = LeaveRequestAttachment::create([
                            'leave_request_id' => $leaveRequest->id,
                            'file' => $fileName,
                        ]);
                       // \Log::info('Attachment created with ID: ' . $attachment->id);
                    } else {
                       // \Log::error('File is not valid in non-admin update');
                    }
                }
            } else {
               // \Log::info('No files found in non-admin update request');
            }

                Flash::success('Leave request updated successfully.');
        }



        return redirect(route('leave-requests.index'));
    }

    /**
     * Delete the specified Leave Request.
     *
     * @param LeaveRequest $leaveRequest
     * @return JsonResponse
     * @throws Exception
     */
  public function destroy(User $user,LeaveRequest $leaveRequest)
    {

        if (auth()->user()->hasRole('Admin')) {
              $leaveRequest->update(['deleted_by' => getLoggedInUserId()]);
              $leaveRequest->delete();
               UserNotification::create([
                'title' => 'Leave Request Deleted',
                'description' => 'Your leave request has been deleted by Admin',
                'link' => url('/leave-requests/' . $leaveRequest->id),
                'type' => LeaveRequest::class,
                'user_id' => $leaveRequest->user_id,
             ]);

             return $this->sendSuccess('Leave Request Deleted Successfully.');
        } else {
            // Non-admin users can only delete their own pending  leave requests
            $user = auth()->user();
            if ($leaveRequest->user_id !== $user->id) {
                return $this->sendError('You Are Not Authorized To Delete This Leave Request.');
            }
            if ($leaveRequest->status !== 'pending') {
                return $this->sendError('You Can Delete Only Pending Leave Requests.');
            }

            if ($leaveRequest->user_id == $user->id && $leaveRequest->status == 'pending') {
                $leaveRequest->update(['deleted_by' => getLoggedInUserId()]);
                $leaveRequest->delete();
                $admins = User::role('Admin')->get();

                foreach ($admins as $admin) {
                    UserNotification::create([
                        'title' => 'Pending Leave Request Deleted',
                        'description' => auth()->user()->name . ' Has Deleted A Pending Leave Request',
                        'link' => url('/leave-requests/' . $leaveRequest->id),
                        'type' => LeaveRequest::class,
                        'user_id' => $admin->id,
                    ]);
                }

              return $this->sendSuccess('Leave Request Deleted Successfully.');
            }

        }

    }

    /**
     * Update the status of the specified Leave Request.
     *
     * @param Request $request
     * @param LeaveRequest $leaveRequest
     * @return JsonResponse
     */
    public function updateStatus(Request $request, LeaveRequest $leaveRequest)
    {
         $isAdmin = auth()->user()->hasRole('Admin');
         if (!$isAdmin) {
           Flash::error('You Are Not Authorized To Update Other Absent Status');
           return redirect()->route('absents.index');
         }else{
            $request->validate([
            'status' => 'required|in:approved,rejected,swap',
             'swap_date' => 'required_if:status,swap|date'
            ]);

            //$leaveRequest->update(['status' => $request->status]);
              if($request->status == 'swap'){
                if($leaveRequest->total_days > 1){
                  return $this->sendError('To Swaped Status Leave Day Can Not Be More Than 1');

                }
                 // Check if swap date is today or in the past (not future)
                $today = now()->startOfDay();
                $swapDate = \Carbon\Carbon::parse($request->swap_date)->startOfDay();

                if ($swapDate->greaterThan($today)) {
                    return $this->sendError('Swap Date Cannot Be A Future Date. Please Select Today Or A Past Date.');
                }
              }
              $leaveRequest->update([
                'status' => $request->status,
                'swap_date' => $request->status == 'swap' ? $request->swap_date : null
            ]);

            $statusText = ucfirst($request->status);

            UserNotification::create([
                'title' => 'Leave Request ' . $statusText,
                'description' => 'Your leave request has been ' . $statusText,
                'link' => url('/leave-requests/' . $leaveRequest->id),
                'type' => LeaveRequest::class,
                'user_id' => $leaveRequest->user_id,
            ]);

            return $this->sendSuccess('Leave request status updated successfully.');
         }

    }

  

    /**
     * Delete attachment from leave request
     *
     * @param LeaveRequestAttachment $attachment
     * @return JsonResponse
     */
    public function deleteAttachment(LeaveRequestAttachment $attachment)
    {
        $leaveRequest = $attachment->leaveRequest;

        // Check permissions
        if (!auth()->user()->hasRole('Admin') &&
            !(auth()->id() == $leaveRequest->user_id && $leaveRequest->status == 'pending')) {
            return $this->sendError('You are not authorized to delete this attachment.');
        }

        // Delete file from storage
        Storage::disk('public')->delete($attachment->file_path);

        // Delete attachment record
        $attachment->delete();

        return $this->sendSuccess('Attachment deleted successfully.');
    }

    /**
     * Download attachment from leave request
     *
     * @param LeaveRequestAttachment $attachment
     * @return \Illuminate\Http\Response
     */


public function downloadAttachment($id)
{
    try {
       // Log::info('Download attachment called with ID: ' . $id);

        // Find attachment
        $attachment = LeaveRequestAttachment::find($id);

        if (!$attachment) {
           // Log::error('Attachment not found with ID: ' . $id);
            return response()->json(['error' => 'Attachment not found'], 404);
        }

       // Log::info('Attachment found: ' . $attachment->file);
        // Log::info('File path from DB: ' . $attachment->file_path);

        // Try multiple possible paths
        $possiblePaths = [
            storage_path('app/public/' . $attachment->file_path),
            public_path('storage/' . $attachment->file_path),
            public_path('uploads/leave_request_attachments/' . $attachment->leave_request_id . '/' . $attachment->file),
            storage_path('app/public/uploads/leave_request_attachments/' . $attachment->leave_request_id . '/' . $attachment->file),
        ];

        $filePath = null;
        foreach ($possiblePaths as $path) {
            // Log::info('Checking path: ' . $path);
            if (file_exists($path)) {
                $filePath = $path;
               // Log::info('File found at: ' . $path);
                break;
            }
        }

        if (!$filePath) {
           // Log::error('File not found in any path');

            // Try direct URL as fallback
            if (filter_var($attachment->file_url, FILTER_VALIDATE_URL)) {
                // Log::info('Trying URL download: ' . $attachment->file_url);
                return redirect()->away($attachment->file_url);
            }

            abort(404, 'File not found.');
        }

        return response()->download($filePath, $attachment->file);

    } catch (\Exception $e) {
        Log::error('Download error: ' . $e->getMessage());
        abort(500, 'Download failed: ' . $e->getMessage());
    }
}

}
