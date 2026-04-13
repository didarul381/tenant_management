<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\Salary;
use App\Models\User;
use App\Repositories\SalaryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Absent;
use App\Models\LeaveRequest;
use App\Models\UserNotification;
use App\Models\Attendance;
class SalaryController extends AppBaseController
{
    private $salaryRepository;

    public function __construct(SalaryRepository $salaryRepo)
    {
        $this->salaryRepository = $salaryRepo;
    }

    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            $data = $this->salaryRepository->getSalaryList($request);
            return datatables()->of($data)
                ->addIndexColumn() // <-- এইটা যোগ করুন
                ->addColumn('action', function ($row) {
                    $viewBtn = '<a href="' . route('salary.show', [$row->year, $row->month]) . '" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>';
                    return $viewBtn;
                })
                ->editColumn('month', function($row) {
                    $months = [
                        1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                        5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                        9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                    ];
                    return $months[$row->month] ?? $row->month;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $users = User::where('is_active', 1)->pluck('name', 'id');
        return view('salary.index', compact('users'));
    }

    public function show($year, $month)
    {
        
         $month_not_formated = (int)$month;
          
        $query = Salary::where('year', $year)->where('month', $month);
        
        // Calculate totals before pagination
        $totalPayable = $query->sum('payable');
        $totalPaid = $query->sum('paid');
        $totalDue = $query->sum('due');
        
        // Get paginated results
        $salaries = $query->with(['user'])->paginate(30);
        
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        $monthYear = ($months[$month] ?? '') . ' ' . $year;
        $month = $months[$month] ?? '';
        $year = (int)$year;
        
       
        return view('salary.show', compact('salaries', 'totalPayable', 'totalPaid', 'totalDue', 'monthYear', 'month', 'year', 'month_not_formated'));
    }

    public function create()
    {
        $users = User::where('is_active', 1)->pluck('name', 'id');
        return view('salary.create', compact('users'));
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'year' => 'required|integer|min:2020|max:' . date('Y'),
            'month' => 'required|integer|min:1|max:12',
        ]);

        $year = $request->year;
        $month = $request->month;
        $includeEidBonus = $request->has('include_eid_bonus');
        $includeLateUnknownPenalty = $request->has('include_late_unknown_penalty');
        
        // Validation 1: Check if future month
        $currentYear = date('Y');
        $currentMonth = date('n');
        
        if ($year > $currentYear || ($year == $currentYear && $month > $currentMonth)) {
            return $this->sendError('Cannot Generate Salary For Future Months.');
        }
        
       
        
        // Also check active (non-deleted) salaries
        $activeSalary = DB::table('salaries')
            ->where('year', $year)
            ->where('month', $month)
            ->whereNull('deleted_at')
            ->first();
            
        if ($activeSalary) {
            return $this->sendError('Salary For This Month Already Generated.');
        }
        
        // Validation 3: Check if previous month salaries are all marked as paid
        $previousMonth = $month - 1;
        $previousYear = $year;
        
        if ($previousMonth < 1) {
            $previousMonth = 12;
            $previousYear = $year - 1;
        }
        
        // Check if there are any salaries for previous month
        $previousMonthSalaries = DB::table('salaries')
            ->where('year', $previousYear)
            ->where('month', $previousMonth)
            ->whereNull('deleted_at')
            ->get();
            
        if ($previousMonthSalaries->isNotEmpty()) {
            // Check if all previous month salaries are marked as paid
            $unpaidSalaries = $previousMonthSalaries->where('status', '!=', 'paid');
            
            if ($unpaidSalaries->isNotEmpty()) {
                $months = [
                    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                ];
                
                $previousMonthName = $months[$previousMonth] ?? '';
                
                return $this->sendError("Some Salary Of Previous Month ({$previousMonthName}/{$previousYear}) Not Marked Received. Please Mark Them Paid");
            }
        }

        $users = User::where('is_active', 1)->get(); // only active users
        $salariesToInsert = [];

        foreach ($users as $user) {
            $basic_salary = $user->salary ?? 0;

            // Absent Penalty Calculation
            $absent_days = Absent::where('user_id', $user->id)
                ->where('status', 'approved')
                ->where('partial_leave', 0)
                ->where(function($q) use ($year, $month) {
                    $q->whereYear('from_date', $year)
                    ->whereMonth('from_date', $month)
                    ->orWhere(function($q2) use ($year, $month) {
                        $q2->whereYear('to_date', $year)
                            ->whereMonth('to_date', $month);
                    });
                })
                ->sum('total_days');

            $absent_penalty = ($basic_salary / 30) * $absent_days * 2; // as per your rule

            // Leave Penalty Calculation
            $leave_requests = LeaveRequest::where('user_id', $user->id)
                ->where('status', 'approved')
                ->where(function($q) use ($year, $month) {
                $q->whereYear('from_date', $year)
                  ->whereMonth('from_date', $month)
                  ->orWhere(function($q2) use ($year, $month) {
                      $q2->whereYear('to_date', $year)
                         ->whereMonth('to_date', $month);
                  });
            })->get();

            $leave_penalty = 0;
            $total_leave_days = 0;

            // Calculate total leave days across all requests
            foreach ($leave_requests as $leave) {
                $total_leave_days += $leave->total_days;
            }

            // Apply penalty: First 1 day is paid leave, each additional day = 1 day salary penalty
            if ($total_leave_days > 1) {
                $penalty_days = $total_leave_days - 1; // subtract 1 for paid leave
                $leave_penalty = ($basic_salary / 30) * $penalty_days;
            }

            // Attendance Penalty Calculation (Late/Unknown) per 3 day
            $attendece_penalty = 0;
            
            if ($includeLateUnknownPenalty) {
                // Count late and unknown attendance for the month
                $lateUnknownCount = Attendance::where('user_id', $user->id)
                    ->whereNull('deleted_at') // Exclude deleted attendances
                    ->where(function($q) use ($year, $month) {
                        $q->whereYear('signing_in_date_time', $year)
                          ->whereMonth('signing_in_date_time', $month);
                    })
                    ->whereIn('status', ['late', 'unknown'])
                    ->count();

                // Calculate penalty: For every 3 late/unknown days, deduct 1 day salary
                if ($lateUnknownCount >= 3) {
                    $penaltyDays = intval($lateUnknownCount / 3); // integer division
                    $attendece_penalty = ($basic_salary / 30) * $penaltyDays;
                }
            }

            // EID Bonus Calculation
            $eid_bonus = $includeEidBonus ? ($basic_salary * 0.5) : 0;

            $payable = $basic_salary - $absent_penalty - $leave_penalty - $attendece_penalty + $eid_bonus;

            $salariesToInsert[] = [
                'user_id' => $user->id,
                'basic_salary' => $basic_salary,
                'house_rent' => $user->house_rent ?? 0,
                'ta_da' => $user->ta_da ?? 0,
                'medical_allowance' => $user->medical_allowance ?? 0,
                'over_time' => 0, // default 0, later can update
                'absent_penalty' => $absent_penalty,
                'leave_penalty' => $leave_penalty,
                'attendece_penalty' => $attendece_penalty,
                'other_penalty' => 0,
                'other_penalty_note' => null,
                'tax' => 0,
                'commission' => 0,
                'eid_bonus' => $eid_bonus,
                'payable' => $payable,
                'paid' => 0,
                'due' => $payable,
                'year' => $year,
                'month' => $month,
                'created_by' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

             UserNotification::create([
                'title' => 'Salary Generated',
                'description' => 'Your Salary Has Been Generated By Admin',
                'link' => url('/salary-acknowledgement/'),
                'type' => Salary::class,
                'user_id' => $user->id,
            ]);
        }

        // Insert all salaries in one query
        DB::table('salaries')->insert($salariesToInsert);
        return $this->sendSuccess('Salary generated successfully.');
    }

   
    public function edit($id)
    {
        $salary = Salary::find($id);
    
        return response()->json([
            'success' => true,
            'data' => $salary
        ]);
    }
    /**
     * Show salary details for a single employee
     */
    public function showDetails($id)
    {
        $salary = Salary::with('user')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $salary
        ]);
    }
    public function update(Request $request, Salary $salary)
    {
        $request->validate([
           //user_id' => 'required|exists:users,id',
           //basic_salary' => 'required|numeric|min:0',
            'house_rent' => 'nullable|numeric|min:0',
            'ta_da' => 'nullable|numeric|min:0',
            'medical_allowance' => 'nullable|numeric|min:0',
            'over_time' => 'nullable|numeric|min:0',
            'commission' => 'nullable|numeric|min:0',
            'eid_bonus' => 'nullable|numeric|min:0',
            'leave_penalty' => 'nullable|numeric|min:0',
            'absent_penalty' => 'nullable|numeric|min:0',
            'attendece_penalty' => 'nullable|numeric|min:0',
            'other_penalty' => 'nullable|numeric|min:0',
            'other_penalty_note' => 'nullable|string|max:250',
            'tax' => 'nullable|numeric|min:0',
        ]);

        $input = $request->all();
        $input['basic_salary'] = $salary->basic_salary;
        $paid = $salary->paid;
         
        // Recalculate payable amount
        $input['payable'] = ($input['basic_salary'] ?? 0) + 
                           ($input['house_rent'] ?? 0) + 
                           ($input['ta_da'] ?? 0) + 
                           ($input['medical_allowance'] ?? 0) + 
                           ($input['commission'] ?? 0) + 
                           ($input['eid_bonus'] ?? 0) + 
                           ($input['over_time'] ?? 0) - 
                           ($input['leave_penalty'] ?? 0) - 
                           ($input['absent_penalty'] ?? 0) - 
                           ($input['attendece_penalty'] ?? 0) - 
                           ($input['other_penalty'] ?? 0) - 
                           ($input['tax'] ?? 0);

        

        // Recalculate due amount
        $input['due'] = $input['payable'] - $paid ;
       // Ensure payable cannot be negative
        if ($input['payable'] < 0) {
            $input['payable'] = 0;
        }
        $salary = $this->salaryRepository->update($input, $salary->id);
         UserNotification::create([
                'title' => 'Salary Updated',
                'description' => 'Your Salary Has Been Updated By Admin',
                'link' => url('/salary-acknowledgement/'),
                'type' => Salary::class,
                'user_id' => $salary->user_id,
            ]);

        return $this->sendSuccess('Salary updated successfully.');
    }

    public function destroy(Salary $salary)
    {
         if ($salary->status === 'paid') {
            return $this->sendError('Cannot Delete Paid Salary.');
         }

        $salary->delete();
                $year = $salary->year;
                 $month = $salary->month;
                  $months = [
                    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                ];
                
                 $month = $months[$month] ?? '';
                 
                 UserNotification::create([
                        'title' => 'Salary Deleted',
                        'description' => 'Your  Salaary Of ' . $month . '/' . $year . ' as ' . 'Deleted By Admin',
                        'link' => url('/salary-acknowledgement/'),
                        'type' => Salary::class,
                        'user_id' => $salary->user_id,
                ]);

        return $this->sendSuccess('Salary deleted successfully.');
    }

    public function markAllPaid($year, $month)
    {

        // Update all due salaries to paid
        DB::table('salaries')
            ->where('year', $year)
            ->where('month', $month)
            ->where('status', 'due')
            ->whereNull('deleted_at')
            ->update([
                'status' => 'paid',
                'paid' => DB::raw('payable'),
                'due' => 0,
                'updated_at' => now()
            ]);

             // Get all salaries for the given year and month with user_id
            $salaries = DB::table('salaries')
                ->where('year', $year)
                ->where('month', $month)
                ->whereNull('deleted_at')
                ->select('id', 'user_id')
                ->get();

             $months = [
                    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                ];
                
                
                $formated_month = $months[$month] ?? '';

             // Create notification for each user
            foreach ($salaries as $salary) {
                UserNotification::create([
                    'title' => 'Salary Marked Paid',
                    'description' => 'Your Salary For ' . $formated_month . '/' . $year . ' Has Been Marked As Paid By Admin.',
                    'link' => url('/salary-acknowledgement/'),
                    'type' => Salary::class,
                    'user_id' => $salary->user_id,
                ]);
            }

          

        return $this->sendSuccess('All salaries marked as paid successfully.');
    }

    public function markAllDue($year, $month)
    {
        // Update all paid salaries to due
        DB::table('salaries')
            ->where('year', $year)
            ->where('month', $month)
            ->where('status', 'paid')
            ->whereNull('deleted_at')
            ->update([
                'status' => 'due',
                'paid' => 0,
                'due' => DB::raw('payable'),
                'updated_at' => now()
            ]);

         // Get all salaries for the given year and month with user_id
            $salaries = DB::table('salaries')
                ->where('year', $year)
                ->where('month', $month)
                ->whereNull('deleted_at')
                ->select('id', 'user_id')
                ->get();

             $months = [
                    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                ];
                
                
                $formated_month = $months[$month] ?? '';

             // Create notification for each user
            foreach ($salaries as $salary) {
                UserNotification::create([
                    'title' => 'Salary Marked Due',
                    'description' => 'Your Salary For ' . $formated_month . '/' . $year . ' Has Been Marked As Due By Admin.',
                    'link' => url('/salary-acknowledgement/'),
                    'type' => Salary::class,
                    'user_id' => $salary->user_id,
                ]);
            }


        return $this->sendSuccess('All salaries marked as due successfully.');
    }

    public function deleteAll($year, $month)
    {
        // Check if any paid salaries exist
        $paidSalaries = DB::table('salaries')
            ->where('year', $year)
            ->where('month', $month)
            ->where('status', 'paid')
            ->whereNull('deleted_at')
            ->first();

        if ($paidSalaries) {
            return $this->sendError('Cannot delete salaries. Some salaries are already marked as paid.');
        }

        // Soft delete all salaries for the month/year
        DB::table('salaries')
            ->where('year', $year)
            ->where('month', $month)
            ->whereNull('deleted_at')
            ->update([
                'deleted_at' => now()
            ]);

        return $this->sendSuccess('All salaries deleted successfully.');
    }

    public function view(Salary $salary)
    {
         $salary = Salary::with('user')->findOrFail($salary->id);
    
        // Calculate total amount
        $total = $salary->basic_salary 
            + $salary->house_rent 
            + $salary->ta_da 
            + $salary->medical_allowance 
            + $salary->over_time;
        
        return view('salary.view', compact('salary', 'total'));
    }
   
    // public function changeStatus(Salary $salary)
    // {
    //     $newStatus = $salary->status === 'paid' ? 'due' : 'paid';
    //     $salary->status = $newStatus;
    //     $salary->save();
        
    //     return $this->sendSuccess('Salary status changed successfully.');
    // }

    public function changeStatus(Salary $salary)
    {
        if ($salary->status === 'paid') {
            // Change from paid to due
            $salary->status = 'due';
            $salary->paid = 0;
            $salary->due = $salary->payable;
        } else {
            // Change from due to paid
            $salary->status = 'paid';
            $salary->paid = $salary->payable;
            $salary->due = 0;
        }
        
        $salary->save();
        
                 $year = $salary->year;
                 $month = $salary->month;
                  $months = [
                    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                ];
                
                 $month = $months[$month] ?? '';
                 $new_status = $salary->status;
                
               
                    UserNotification::create([
                        'title' => 'Admin Change Status',
                        'description' => 'Admin Marked Your Salary For ' . $month . '/' . $year . ' As ' . $new_status,
                        'link' => url('/salary-acknowledgement/'),
                        'type' => Salary::class,
                        'user_id' => $salary->user_id,
                    ]);
        
        
        return $this->sendSuccess('Salary status changed successfully.');
    }

    public function updateStatus(Request $request, Salary $salary)
    {
        $request->validate([
            'paid' => 'required|numeric|min:0',
        ]);

        $salary->update([
            'paid' => $request->paid,
            'due' => $salary->payable - $request->paid,
        ]);

        return $this->sendSuccess('Salary status updated successfully.');
    }

    /**
     * Print Native Bank (Premier Bank) Salaries
     */
    public function printNativeBank($year, $month)
    {
        $salaries = Salary::where('year', $year)
            ->where('month', $month)
            ->where('payable', '>', 0) // Only include salaries with payable > 0
            ->with(['user' => function($query) {
                $query->whereNotNull('bank_name')
                      ->whereNotNull('account_name')
                      ->whereNotNull('account_number')
                      ->where('hold_account', '!=', 1);
            }])
            ->get()
            ->filter(function($salary) {
                // Filter only users with Premier Bank
                return $salary->user && 
                       strpos(strtolower($salary->user->bank_name ?? ''), 'premier') !== false;
            });

        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        $monthName = $months[$month] ?? '';

        return view('salary.print-native-bank', compact('salaries', 'year', 'month', 'monthName'));
    }

    /**
     * Print Other Bank (Non-Premier) Salaries
     */
    public function printOtherBank($year, $month)
    {
        $salaries = Salary::where('year', $year)
            ->where('month', $month)
            ->where('payable', '>', 0) // Only include salaries with payable > 0
            ->with(['user' => function($query) {
                $query->whereNotNull('bank_name')
                      ->whereNotNull('account_name')
                      ->whereNotNull('account_number')
                      ->where('hold_account', '!=', 1);
            }])
            ->get()
            ->filter(function($salary) {
                // Filter users with bank info but NOT Premier Bank
                return $salary->user && 
                       (strpos(strtolower($salary->user->bank_name ?? ''), 'premier') === false);
            });

        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        $monthName = $months[$month] ?? '';

        return view('salary.print-other-bank', compact('salaries', 'year', 'month', 'monthName'));
    }

    /**
     * Print Hand Cash (No Bank Info) Salaries
     */
    public function printHandCash($year, $month)
    {
        $salaries = Salary::where('year', $year)
            ->where('month', $month)
            ->with(['user' => function($query) {
                // Include users with no bank info OR users with hold account
                $query->where(function($userQuery) {
                    $userQuery->where(function($subQuery) {
                        $subQuery->whereNull('bank_name')
                              ->orWhereNull('account_name')
                              ->orWhereNull('account_number');
                    })
                    ->orWhere('hold_account', '=', 1);
                });
            }])
            ->get()
            ->filter(function($salary) {
                // Double check user has no bank info OR has hold account
                return $salary->user && 
                       ((empty($salary->user->bank_name) || 
                        empty($salary->user->account_name) || 
                        empty($salary->user->account_number)) || 
                        $salary->user->hold_account == 1);
            });

        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        $monthName = $months[$month] ?? '';

        return view('salary.print-hand-cash', compact('salaries', 'year', 'month', 'monthName'));
    }
}
