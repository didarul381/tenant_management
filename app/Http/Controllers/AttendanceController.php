<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\BreakTime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absent;
use App\Models\LeaveRequest;
use DateTime;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $startDate = $request->input('start_date', now()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $attendances = Attendance::with(['user', 'deletedBy'])
            ->forUser($userId)
            ->whereBetween('signing_in_date_time', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])
            ->orderBy('signing_in_date_time', 'desc')
            ->paginate(20);

        // Add break duration to each attendance record
        $attendances->setCollection(
            $attendances->getCollection()->map(function ($attendance) {
                $totalBreakSeconds = BreakTime::forUser($attendance->user_id)
                    ->whereDate('break_start_time', $attendance->signing_in_date_time->format('Y-m-d'))
                    ->sum('duration');
                
                $attendance->total_break_seconds = $totalBreakSeconds;
                return $attendance;
            })
        );

        // Handle AJAX request
        if ($request->ajax()) {
            $html = '';
            foreach ($attendances as $index => $attendance) {
                $html .= '<tr>';
                $html .= '<td>' . ($attendances->firstItem() + $index) . '</td>';
                $html .= '<td>' . ($attendance->signing_in_date_time ? $attendance->signing_in_date_time->format('M d, Y') : '-') . '</td>';

                $html .= '<td>' . ($attendance->signing_in_date_time ? $attendance->signing_in_date_time->copy()->addHours(6)->format('h:i A') : '-') . '</td>';
                $html .= '<td>' . ($attendance->signing_out_date_time ? $attendance->signing_out_date_time->copy()->addHours(6)->format('h:i A') : '-') . '</td>';
                
                $html .= '<td>';
                if ($attendance->duration) {
                    $html .= floor($attendance->duration / 60) . 'h ' . ($attendance->duration % 60) . 'm';
                } else {
                    $html .= '-';
                }
                $html .= '</td>';
                
                // Break column
                $html .= '<td>';
                if ($attendance->total_break_seconds) {
                    if ($attendance->total_break_seconds < 60) {
                        $html .= $attendance->total_break_seconds . 's';
                    } else {
                        $breakMinutes = floor($attendance->total_break_seconds / 60);
                        $breakSeconds = $attendance->total_break_seconds % 60;
                        if ($breakSeconds > 0) {
                            $html .= $breakMinutes . 'm ' . $breakSeconds . 's';
                        } else {
                            $html .= $breakMinutes . 'm';
                        }
                    }
                } else {
                    $html .= '-';
                }
                $html .= '</td>';
                
                $html .= '<td>' . ($attendance->office_time ?? '-') . '</td>';
                $html .= '<td>';
                if ($attendance->status == 'in_time') {
                    $html .= '<span class="badge badge-success">In Time</span>';
                } elseif ($attendance->status == 'late') {
                    $html .= '<span class="badge badge-danger">Late</span>';
                } elseif ($attendance->status == 'excuse') {
                    $html .= '<span class="badge badge-info">Excuse</span>';
                } else {
                    $html .= '<span class="badge badge-warning">Unknown</span>';
                }
                $html .= '</td>';  
                $html .= '<td>';
                                if ($attendance->note == 'Office Time and Duration Matched') {
                                    $html .= '<span class="badge badge-success">Office Time and Duration Matched</span>';
                                } elseif ($attendance->note == 'Office Time and Duration Not Matched') {
                                    $html .= '<span class="badge badge-danger">Office Time and Duration MisMatch</span>';
                                } elseif ($attendance->note == 'Forgot To Give Check out') {
                                    $html .= '<span class="badge badge-danger">Forgot To Give Check out</span>';
                                } elseif ($attendance->note == 'Duration Met but Timing Mismatch') {
                                    $html .= '<span class="badge badge-danger">Duration Met but Timing Mismatch</span>';
                                } else {
                                    $html .= '<span class="">' . ($attendance->note ?? '-') . '</span>';
                                }
                $html .= '</td>';

                $html .= '</tr>';
            }

            if ($attendances->isEmpty()) {
                $html = '<tr><td colspan="9" class="text-center">No attendance records found</td></tr>';
            }

            $pagination = $attendances->links()->toHtml();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        return view('attendances.index', compact('attendances', 'startDate', 'endDate'));
    }

    public function myAttendance()
    {
        $userId = Auth::id();
        $attendances = Attendance::forUser($userId)
            ->orderBy('signing_in_date_time', 'desc')
            ->paginate(20);

        return view('attendances.my_attendance', compact('attendances'));
    }

    public function signIn()
    {
        $userId = Auth::id();

        // Check if user already signed in today
        $existingAttendance = Attendance::forUser($userId)
            ->today()
            ->whereNull('signing_out_date_time')
            ->first();

        if ($existingAttendance) {
            return response()->json([
                'success' => false,
                'message' => 'You have already signed in today.'
            ], 400);
        }

        // Check if user already completed attendance for today
        $completedAttendance = Attendance::forUser($userId)
            ->today()
            ->whereNotNull('signing_out_date_time')
            ->first();

        if ($completedAttendance) {
            return response()->json([
                'success' => false,
                'message' => 'You have already completed your attendance for today.'
            ], 400);
        }

        $signInTime = Carbon::now();

        // Get user's office time
        $user = User::find($userId);
        $officeFromTime = $user->office_from_time ?? '11:00';
        $officeToTime = $user->office_to_time ?? '19:00';

        // Convert to 12-hour format with AM/PM
        $fromTime = Carbon::parse($officeFromTime)->format('h:i A');
        $toTime = Carbon::parse($officeToTime)->format('h:i A');
        $officeTime = $fromTime . ' - ' . $toTime;

        $attendance = Attendance::create([
            'user_id' => $userId,
            'signing_in_date_time' => $signInTime,
            'status' => $this->calculateStatus($signInTime, $userId),
            'office_time' => $officeTime,
            'note' => "Only Just Checked in",
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Checked in successfully',
            'data' => $attendance
        ]);
    }

    public function signOut(Request $request)
    {
        $userId = Auth::id();

        $attendance = Attendance::forUser($userId)
            ->today()
            ->whereNull('signing_out_date_time')
            ->first();

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'No active check-in found for today. Please check in first.'
            ], 400);
        }

        $user = User::find($userId);

        // Default office times
        $officeFromTime = '11:00'; // 11:00 AM
        $officeToTime = '19:00';  // 7:00 PM

        if ($user) {
            if ($user->office_from_time) {
                $officeFromTime = $user->office_from_time;
            }
            if ($user->office_to_time) {
                $officeToTime = $user->office_to_time;
            }
        }

        $signOutTime = Carbon::now();

        // Calculate duration from check-in to check-out
        $actualDuration = $attendance->signing_in_date_time->diffInMinutes($signOutTime);

        // Calculate expected office duration
        $fromParts = explode(':', $officeFromTime);
        $toParts = explode(':', $officeToTime);

        $officeStart = Carbon::today()->setHour((int)$fromParts[0])->setMinute((int)$fromParts[1])->setSecond(0);
        $officeEnd = Carbon::today()->setHour((int)$toParts[0])->setMinute((int)$toParts[1])->setSecond(0);

        // Handle case where office end time is next day (e.g., 22:00 to 06:00)
        if ($officeEnd->lt($officeStart)) {
            $officeEnd->addDay();
        }

        $expectedDuration = $officeStart->diffInMinutes($officeEnd);

        // Determine status based on actual duration vs expected duration
        if ($actualDuration >= $expectedDuration) {
            $status = 'in_time';
        } else {
            $status = 'late';
        }

        // old code Check if user worked within office hours
        //$checkInWithinOffice = $attendance->signing_in_date_time->lte($officeStart);
      //  $checkOutWithinOffice = $signOutTime->gte($officeEnd);

       // if ($checkInWithinOffice && $checkOutWithinOffice) {
            //$note = 'Office Time and Duration Matched';
       // } else {
           // $note = 'Office Time and Duration Not Matched';
       // }

       
	   // new code Check if user worked full duration and within office hours
		$checkInTimeStr = $attendance->signing_in_date_time->format('H:i');
		$checkOutTimeStr = $signOutTime->format('H:i');
		$officeStartStr = $officeStart->format('H:i');
		$officeEndStr = $officeEnd->format('H:i');

		// Case 1: User checked in before/at office start and checked out after/at office end
		if ($checkInTimeStr <= $officeStartStr && $checkOutTimeStr >= $officeEndStr) {
			$note = 'Office Time and Duration Matched';
		} 
		// Case 2: User worked full duration (at least expected hours) but timing mismatched
		elseif ($actualDuration >= $expectedDuration) {
			$note = 'Duration Met but Timing Mismatch';
		}
		// Case 3: User didn't work full duration
		else {
			$note = 'Office Time and Duration Not Matched';
		}


        // Check if user has any active break and automatically end it
        $activeBreak = BreakTime::forUser($userId)
            ->active()
            ->first();

        if ($activeBreak) {
            // End the active break automatically
            $breakEndTime = $signOutTime;
            $breakDuration = $activeBreak->break_start_time->diffInSeconds($breakEndTime);

            $activeBreak->update([
                'break_back_time' => $breakEndTime,
                'duration' => $breakDuration,
            ]);
        }

        // Update attendance record using update method
        $updateResult = $attendance->update([
            'signing_out_date_time' => $signOutTime,
            'duration' => $actualDuration,
            'status' => $status,
            'note' => $note,
        ]);

        // Refresh the model to get updated values
        $attendance->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Checked out successfully!',
            'data' => $attendance
        ]);
    }

    public function getCurrentStatus()
    {
        $userId = Auth::id();

        $todayAttendance = Attendance::forUser($userId)
            ->today()
            ->first();

        $status = [
            'is_signed_in' => false,
            'is_signed_out' => false,
            'is_on_break' => false,
            'attendance' => null
        ];

        if ($todayAttendance) {
            $status['attendance'] = $todayAttendance;
            $status['is_signed_in'] = $todayAttendance->isSignedIn();
            $status['is_signed_out'] = $todayAttendance->isSignedOut();
            
            // Check if user is currently on break
            if ($status['is_signed_in']) {
                $activeBreak = BreakTime::forUser($userId)
                    ->active()
                    ->first();
                $status['is_on_break'] = !is_null($activeBreak);
            }
        }

        return response()->json($status);
    }

    public function update(Request $request, $id)
    {
         $isAdmin = auth()->user()->hasRole('Admin');
        if (!$isAdmin) {
       
            return response()->json([
                'success' => false,
                'message' => 'You Are Not Authorized To Update Attendence'
            ], 422);
           return redirect()->back();
        }
        $attendance = Attendance::findOrFail($id);

        // Validate check out time is not earlier than check in time
        $checkInTime = $request->input('signing_in_date_time');
        $checkOutTime = $request->input('signing_out_date_time');

        if ($checkOutTime && $checkInTime && new DateTime($checkOutTime) <= new DateTime($checkInTime)) {
            return response()->json([
                'success' => false,
                'message' => 'Check out time cannot be earlier than check in time'
            ], 422);
        }

        // Validation 1: Check if dates are the same
        if ($checkInTime && $checkOutTime) {
            $checkInDate = new DateTime($checkInTime);
            $checkOutDate = new DateTime($checkOutTime);

            if ($checkInDate->format('Y-m-d') !== $checkOutDate->format('Y-m-d')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Check in and check out dates must be the same day'
                ], 422);
            }
        }

        // Validation 2: Check for future date
        if ($checkInTime) {
            $checkInDate = new DateTime($checkInTime);
            $today = new DateTime();
            $today->setTime(0, 0, 0);
            $checkInDateOnly = new DateTime($checkInDate->format('Y-m-d'));

            if ($checkInDateOnly > $today) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot give attendance for future dates'
                ], 422);
            }
        }

        // Validation 3: Check for duplicate attendance (only if date is changing)
        if ($checkInTime) {
            $checkInDate = new DateTime($checkInTime);
            $dateOnly = $checkInDate->format('Y-m-d');

            // Check if there's already attendance for this date (excluding current record)
            $existingAttendance = Attendance::where('user_id', $attendance->user_id)
                ->whereDate('signing_in_date_time', $dateOnly)
                ->where('id', '!=', $attendance->id)
                ->first();

            if ($existingAttendance) {
                return response()->json([
                    'success' => false,
                    'message' => 'Attendance already exists for this date: ' . $dateOnly
                ], 422);
            }
        }

        // Update attendance record
        $attendance->update([
            'note' => $request->input('note'),
            'signing_in_date_time' => $checkInTime ? Carbon::parse($checkInTime)->subHours(6) : $attendance->signing_in_date_time,
            'signing_out_date_time' => $checkOutTime ? Carbon::parse($checkOutTime)->subHours(6) : $attendance->signing_out_date_time,
        ]);

        // Validation 4: Calculate status based on office time duration
        if ($checkInTime && $checkOutTime && $attendance->office_time) {
            // Parse office time (e.g., "11:00 - 19:00")
            $officeTimeParts = explode(' - ', $attendance->office_time);
            if (count($officeTimeParts) == 2) {
                $officeStart = new DateTime($officeTimeParts[0]);
                $officeEnd = new DateTime($officeTimeParts[1]);
                $officeDuration = $officeEnd->getTimestamp() - $officeStart->getTimestamp();
                $officeHours = $officeDuration / 3600; // Convert to hours

                // Calculate actual duration
                $checkIn = new DateTime($checkInTime);
                $checkOut = new DateTime($checkOutTime);
                $actualDuration = $checkOut->getTimestamp() - $checkIn->getTimestamp();
                $actualHours = $actualDuration / 3600; // Convert to hours

                // Update status based on duration comparison
                $status = ($actualHours < $officeHours) ? 'late' : 'in_time';
                $attendance->update(['status' => $status]);
            }
        }

        // Recalculate duration if times changed
        if ($checkInTime && $checkOutTime) {
            $checkIn = new DateTime($checkInTime);
            $checkOut = new DateTime($checkOutTime);
            $duration = $checkOut->getTimestamp() - $checkIn->getTimestamp();
            $attendance->update(['duration' => $duration / 60]); // Convert to minutes
        }

        return response()->json([
            'success' => true,
            'message' => 'Attendance updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $isAdmin = auth()->user()->hasRole('Admin');
       
         if (!$isAdmin) {
       
            return response()->json([
                'success' => false,
                'message' => 'You Are Not Authorized To Delete Attendence'
            ], 422);
           return redirect()->back();
        }
        $attendance = Attendance::findOrFail($id);
         $attendance->update(['deleted_by' => getLoggedInUserId()]);
         $attendance->delete();
        return response()->json([
            'success' => true,
            'message' => 'Attendance deleted successfully!'
        ]);
    }

    

     public function report(Request $request)
    {
        $startDate = $request->input('start_date', now()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());
        $userId = $request->input('user_id');
        $status = $request->input('status');
        $today = Carbon::today();
        // Fri=1, Sat=2, Sun=3...
        $isoDay = $today->dayOfWeekIso;
        $todayNumber = (($isoDay + 3) % 7) ?: 7;
        $todayNumber = (string) $todayNumber;

        $query = Attendance::with(['user', 'deletedBy'])
            ->whereBetween('signing_in_date_time', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ]);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $attendances = $query->orderBy('signing_in_date_time', 'desc')->paginate(20);
        $users = User::where('deleted_at', null)->orderBy('name')->get();

        // Add break duration to each attendance record
        $attendances->setCollection(
            $attendances->getCollection()->map(function ($attendance) {
                $totalBreakSeconds = BreakTime::forUser($attendance->user_id)
                    ->whereDate('break_start_time', $attendance->signing_in_date_time->format('Y-m-d'))
                    ->sum('duration');
                
                $attendance->total_break_seconds = $totalBreakSeconds;
                return $attendance;
            })
        );

        // Handle AJAX request
        if ($request->ajax()) {
            $html = '';
            foreach ($attendances as $index => $attendance) {
                $html .= '<tr>';
                $html .= '<td>' . ($attendances->firstItem() + $index) . '</td>';
                $html .= '<td>' . ($attendance->user->name ?? 'N/A') . '</td>';
                $html .= '<td>' . ($attendance->signing_in_date_time ? $attendance->signing_in_date_time->format('M d, Y') : '-') . '</td>';
                $html .= '<td>' . ($attendance->signing_in_date_time ? $attendance->signing_in_date_time->copy()->addHours(6)->format('h:i A') : '-') . '</td>';
                $html .= '<td>' . ($attendance->signing_out_date_time ? $attendance->signing_out_date_time->copy()->addHours(6)->format('h:i A') : '-') . '</td>';
               
                $html .= '<td>';
                if ($attendance->duration) {
                    $html .= floor($attendance->duration / 60) . 'h ' . ($attendance->duration % 60) . 'm';
                } else {
                    $html .= '-';
                }
                $html .= '</td>';
                
                // Break column
                $html .= '<td>';
                if ($attendance->total_break_seconds) {
                    if ($attendance->total_break_seconds < 60) {
                        $html .= $attendance->total_break_seconds . 's';
                    } else {
                        $breakMinutes = floor($attendance->total_break_seconds / 60);
                        $breakSeconds = $attendance->total_break_seconds % 60;
                        if ($breakSeconds > 0) {
                            $html .= $breakMinutes . 'm ' . $breakSeconds . 's';
                        } else {
                            $html .= $breakMinutes . 'm';
                        }
                    }
                } else {
                    $html .= '-';
                }
                $html .= '</td>';
                
                $html .= '<td>' . ($attendance->office_time ?? '-') . '</td>';
                $html .= '<td>';
                if ($attendance->status == 'in_time') {
                    $html .= '<span class="badge badge-success">In Time</span>';
                } elseif ($attendance->status == 'late') {
                    $html .= '<span class="badge badge-danger">Late</span>';
                } elseif ($attendance->status == 'excuse') {
                    $html .= '<span class="badge badge-info">Excuse</span>';
                } else {
                    $html .= '<span class="badge badge-warning">Unknown</span>';
                }
                $html .= '</td>';
                            
                $html .= '<td>';
                                if ($attendance->note == 'Office Time and Duration Matched') {
                                    $html .= '<span class="badge badge-success">Office Time and Duration Matched</span>';
                                } elseif ($attendance->note == 'Office Time and Duration Not Matched') {
                                    $html .= '<span class="badge badge-danger">Office Time and Duration MisMatch</span>';
                                } elseif ($attendance->note == 'Forgot To Give Check out') {
                                    $html .= '<span class="badge badge-danger">Forgot To Give Check out</span>';
                                } elseif ($attendance->note == 'Duration Met but Timing Mismatch') {
                                    $html .= '<span class="badge badge-danger">Duration Met but Timing Mismatch</span>';
                                } else {
                                    $html .= '<span class="">' . ($attendance->note ?? '-') . '</span>';
                                }
                $html .= '</td>';
                // $html .= '<td>' . ($attendance->note ?? '-') . '</td>';
                if(auth()->user()->hasRole('Admin')){
                    $html .= '<td>';
                    $html .= '<button class="btn btn-sm btn-info edit-btn"
                        data-id="' . $attendance->id . '"
                        data-note="' . ($attendance->note ?? '') . '"
                        data-check-in-time="' . ($attendance->signing_in_date_time ? $attendance->signing_in_date_time->copy()->addHours(6)->format('Y-m-d\TH:i:s') : '') . '"
                        data-check-out-time="' . ($attendance->signing_out_date_time ? $attendance->signing_out_date_time->copy()->addHours(6)->format('Y-m-d\TH:i:s') : '') . '"
                        data-duration="' . ($attendance->duration ? floor($attendance->duration / 60) . 'h ' . ($attendance->duration % 60) . 'm' : '') . '">
                        <i class="fas fa-edit"></i></button>';
                    
                    // Add excuse button if status is not already excuse and not in_time
                    if ($attendance->status != 'excuse' && $attendance->status != 'in_time') {
                        $html .= '<button type="button" class="btn btn-sm btn-warning excuse-btn ml-1" 
                                    data-id="' . $attendance->id . '" 
                                    data-user-name="' . ($attendance->user->name ?? 'N/A') . '"
                                    data-date="' . ($attendance->signing_in_date_time ? $attendance->signing_in_date_time->format('M d, Y') : 'N/A') . '"
                                    title="Mark as Excuse">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>';
                    }
                    
                    $html .= '  <button type="button" class="btn btn-sm btn-danger delete-attendence ml-1" data-id="' . $attendance->id . '">
                                                                    <i class="fa fa-trash"></i>
                                                                </button> ';
                    $html .= '</td>';
                }
                $html .= '</tr>';
            }

            if ($attendances->isEmpty()) {
                $html = '<tr><td colspan="' . ((auth()->user()->hasRole('Admin')) ? 11 : 10) . '" class="text-center">No attendance records found</td></tr>';
            }

            $pagination = $attendances->links()->toHtml();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        // For initial page load (non-AJAX), add missing users
        if (!$request->ajax()) {
            // Get all active users who joined before today
            $allActiveUsers = User::where('is_active', 1)
                ->whereDate('joining_date', '<=', $today)
                ->whereNull('deleted_at')
                ->orderBy('name')
                ->get();

            // Get user IDs who have attendance today
            $attendanceUserIds = $attendances->pluck('user_id')->unique()->toArray();

            // Find users who don't have attendance today
            $missingUsers = $allActiveUsers->whereNotIn('id', $attendanceUserIds);

            // Filter missing users based on conditions
            $filteredMissingUsers = $missingUsers->filter(function ($user) use ($todayNumber, $today) {
                // Check if user is on weekly holiday
                $isWeeklyHoliday = false;
                if ($user->weekly_holidays) {
                    $holidays = json_decode($user->weekly_holidays);
                    if (is_array($holidays) && in_array($todayNumber, $holidays)) {
                        $isWeeklyHoliday = true;
                    }
                }

                // Check if user is on approved leave
                $isOnLeave = \DB::table('leave_requests')
                    ->where('user_id', $user->id)
                    ->whereDate('from_date', '<=', $today)
                    ->whereDate('to_date', '>=', $today)
                    ->where('status', 'approved')
                    ->whereNull('deleted_at')
                    ->exists();

                // Check if user is on approved absent (fix: use proper relationship name)
                $isOnAbsent = false;
                // Try to find absent relationship or use direct query
                try {
                    $isOnAbsent = \DB::table('absents')
                        ->where('user_id', $user->id)
                        ->whereDate('from_date', '<=', $today)
                        ->whereDate('to_date', '>=', $today)
                        ->where('status', 'approved')
                        ->whereNull('deleted_at')
                        ->exists();
                } catch (\Exception $e) {
                    // If absents table doesn't exist or has different structure
                    $isOnAbsent = false;
                }

                // Show user only if NOT on holiday, leave, or absent
                return !$isWeeklyHoliday && !$isOnLeave && !$isOnAbsent;
            });

            // Create missing user records for display
            $missingAttendanceRecords = $filteredMissingUsers->map(function ($user) {
                $missingAttendance = new \stdClass();
                $missingAttendance->id = null;
                $missingAttendance->user_id = $user->id;
                $missingAttendance->user = $user;
                $missingAttendance->signing_in_date_time = null;
                $missingAttendance->signing_out_date_time = null;
                $missingAttendance->duration = null;
                $missingAttendance->office_time = null;
                $missingAttendance->status = 'no_attendance';
                $missingAttendance->note = null;
                $missingAttendance->total_break_seconds = 0;
                $missingAttendance->deleted_at = null;
                $missingAttendance->deletedBy = null;
                $missingAttendance->is_missing_user = true; // Flag to identify missing users
                return $missingAttendance;
            });

            // Combine attendance records with missing user records
            $allRecords = $attendances->getCollection()->concat($missingAttendanceRecords);
            
            // Sort by user name, but with missing users first
            $allRecords = $allRecords->sortBy(function ($record) {
                $hasAttendance = !isset($record->is_missing_user) || !$record->is_missing_user;
                return [$hasAttendance ? 1 : 0, $record->user->name ?? ''];
            });

            // Update the paginated collection
            $attendances->setCollection($allRecords);
        }

        return view('attendances.user_report', compact('attendances', 'users', 'startDate', 'endDate'));
    }

    private function calculateStatus($signInTime, $userId)
    {
        $user = User::find($userId);

        // Get user's office time
        $officeFromTime = $user->office_from_time ?? '11:00';
        $officeToTime = $user->office_to_time ?? '19:00';
        $officeTime = $officeFromTime . ' - ' . $officeToTime;

        if ($user) {
            if ($user->office_from_time) {
                $officeTime = $user->office_from_time . ' - ' . ($user->office_to_time ?? '19:00');
            }
        }

        // Parse office time (e.g., "11:00 - 19:00")
        $officeTimeParts = explode(' - ', $officeTime);
        if (count($officeTimeParts) == 2) {
            $startTimeStr = trim($officeTimeParts[0]);
            $startTime = Carbon::parse($startTimeStr);
            // Adjust for timezone: assuming local is UTC+6, convert office start to UTC
            $localHour = $startTime->hour;
            $utcHour = $localHour - 6;
            if ($utcHour < 0) {
                $utcHour += 24;
                $workingHourStart = Carbon::yesterday()->setHour($utcHour)->setMinute($startTime->minute)->setSecond(0);
            } else {
                $workingHourStart = Carbon::today()->setHour($utcHour)->setMinute($startTime->minute)->setSecond(0);
            }
        } else {
            // Fallback to default
            $workingHourStart = Carbon::today()->setHour(5)->setMinute(0)->setSecond(0); // 11:00 local = 5:00 UTC
        }

        
		   
		   // without grace period Compare only hours and minutes, ignore seconds
			// $signInTimeFormatted = $signInTime->format('H:i');
			// $workingHourStartFormatted = $workingHourStart->format('H:i');
			
			// if ($signInTimeFormatted <= $workingHourStartFormatted) {
			// 	return 'in_time';
			// } else {
			// 	return 'late';
			// }
		  
		   // with grace period Compare only hours and minutes, ignore seconds
            $signInTimeFormatted = $signInTime->format('H:i');
            $workingHourStartFormatted = $workingHourStart->format('H:i');
            
            // Add 5 minutes grace period to working hour start
            $gracePeriodEnd = $workingHourStart->copy()->addMinutes(5);
            $gracePeriodEndFormatted = $gracePeriodEnd->format('H:i');
            
            if ($signInTimeFormatted <= $gracePeriodEndFormatted) {
                return 'in_time';
            } else {
                return 'late';
            }
           
    }

    /**
     * Mark attendance as excuse
     *
     * @param  Attendance  $attendance
     * @return JsonResponse
     */
    public function markExcuse(Attendance $attendance): JsonResponse
    {
        try {
            $attendance->status = 'excuse';
            $attendance->save();

            return response()->json([
                'success' => true,
                'message' => 'Attendance marked as excuse successfully.'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to mark attendance as excuse: ' . $e->getMessage()
            ], 500);
        }
    }

    public function startBreak()
    {
        try {
            $userId = Auth::id();
            
            // Check if user is currently checked in
            $todayAttendance = Attendance::forUser($userId)
                ->today()
                ->first();

            if (!$todayAttendance || !$todayAttendance->isSignedIn()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be checked in to start a break.'
                ], 422);
            }

            // Check if user is already on break
            $activeBreak = BreakTime::forUser($userId)
                ->active()
                ->first();

            if ($activeBreak) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are already on break.'
                ], 422);
            }

            // Create new break record
            BreakTime::create([
                'user_id' => $userId,
                'break_start_time' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Break started successfully.'
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to start break: ' . $e->getMessage()
            ], 500);
        }
    }

    public function endBreak()
    {
        try {
            $userId = Auth::id();
            
            // Find active break
            $activeBreak = BreakTime::forUser($userId)
                ->active()
                ->first();

            if (!$activeBreak) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active break found.'
                ], 422);
            }

            // Update break record with end time and duration
            $endTime = now();
            $duration = $activeBreak->break_start_time->diffInSeconds($endTime);

            $activeBreak->update([
                'break_back_time' => $endTime,
                'duration' => $duration,
            ]);

            // Format duration for response message
            if ($duration < 60) {
                $durationText = $duration . ' seconds';
            } else {
                $minutes = floor($duration / 60);
                $seconds = $duration % 60;
                if ($seconds > 0) {
                    $durationText = $minutes . ' minutes ' . $seconds . ' seconds';
                } else {
                    $durationText = $minutes . ' minutes';
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Back successfully. Duration: ' . $durationText . '.'
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to end break: ' . $e->getMessage()
            ], 500);
        }
    }
}
