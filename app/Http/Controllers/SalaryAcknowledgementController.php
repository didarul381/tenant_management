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

class SalaryAcknowledgementController extends AppBaseController
{
    //
     private $salaryRepository;

    public function __construct(SalaryRepository $salaryRepo)
    {
        $this->salaryRepository = $salaryRepo;
    }


     /**
     * User Salary Acknowledgement 
     */
     public function index(Request $request)
     {
        $userId = auth::id();
        $query = Salary::where('user_id', $userId)->orderBy('year', 'desc')->orderBy('month', 'desc');
        
        // Calculate totals before pagination
        $totalPayable = $query->sum('payable');
        $totalPaid = $query->sum('paid');
        $totalDue = $query->sum('due');
        
        // Get paginated results
       
        $salaries = $query->paginate(10);
        
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
       
        
       
        return view('salary.salary_acknowledgement', compact('salaries', 'totalPayable', 'totalPaid', 'totalDue'));
     }

       /**
     * Show salary View details for a single month
     */

      public function showDetails($id)
        {
            $salary = Salary::with('user')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $salary
            ]);
        }

         /**
     * Marked salary status  paid for a single month
     */


         public function changeStatus(Salary $salary)
            {
              
                
                    $salary->status = 'paid';
                    $salary->paid = $salary->payable;
                    $salary->due = 0;
              
                
                $salary->save();
                 $admins = User::role('Admin')->get();
                 $year = $salary->year;
                 $month = $salary->month;
                  $months = [
                    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                ];
                
                
                $month = $months[$month] ?? '';
                $link_month = $salary->month;
                 $new_status = 'Received';
                 $link = url("salary/{$year}/{$link_month}");
                foreach ($admins as $admin) {
                    UserNotification::create([
                        'title' => 'User Received Salary',
                        'description' => auth()->user()->name . ' marked salary for ' . $month . '/' . $year . ' as ' . $new_status,
                         'link' => $link,
                        'type' => Salary::class,
                        'user_id' => $admin->id,
                    ]);
                }
                
                return $this->sendSuccess('Salary Status Marked Paid Successfully.');
            }

}
