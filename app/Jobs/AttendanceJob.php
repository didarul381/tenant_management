<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\LeaveRequest;
use App\Models\Absent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\Models\UserNotification;

class AttendanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $currentDate = now()->toDateString();

        // Step 1: Check if current date is a holiday
        $isHoliday = Event::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->where('type', 2) // Type 2 = Holiday
            ->exists();

        if ($isHoliday) {
           // \Log::info("Date {$currentDate} is a holiday. Skipping attendance check.");
            return;
        }

        // Step 2: Get all active users
        $activeUsers = User::where('is_active', 1)->get();

        foreach ($activeUsers as $user) {
            // Step 3: Check user's weekly holidays
            $currentDayOfWeekIso = now()->dayOfWeekIso; // 1=Monday, 7=Sunday
            $weeklyHolidays = $user->weekly_holidays ?? [];

            // Decode weekly holidays if it's a JSON string
            if (is_string($weeklyHolidays)) {
                $weeklyHolidays = json_decode($weeklyHolidays, true) ?? [];
            }

            // Map dayOfWeekIso to user's holiday numbering
            $dayMapping = [
                1 => 4, // Monday -> 4
                2 => 5, // Tuesday -> 5
                3 => 6, // Wednesday -> 6
                4 => 7, // Thursday -> 7
                5 => 1, // Friday -> 1
                6 => 2, // Saturday -> 2
                7 => 3, // Sunday -> 3
            ];

            $currentDayNum = $dayMapping[$currentDayOfWeekIso] ?? null;

            // Day names for logging
            $dayNames = [
                1 => __('Friday'),
                2 => __('Saturday'),
                3 => __('Sunday'),
                4 => __('Monday'),
                5 => __('Tuesday'),
                6 => __('Wednesday'),
                7 => __('Thursday'),
            ];

            $currentDayName = $dayNames[$currentDayNum] ?? 'Unknown';

            if ($currentDayNum && in_array($currentDayNum, $weeklyHolidays)) {
                // \Log::info("User {$user->id} has weekly holiday on {$currentDayName} (day {$currentDayNum}). Skipping.");
                continue;
            }

            // Step 4: Check if user has attendance record for current date
            $attendance = Attendance::where('user_id', $user->id)
                ->whereDate('signing_in_date_time', $currentDate)
                ->first();

            if ($attendance) {
                // Step 5: If attendance exists, check if both check-in and check-out are present
                if ($attendance->signing_in_date_time && $attendance->signing_out_date_time) {
                   // \Log::info("User {$user->id} has complete attendance for {$currentDate}. Skipping.");
                    continue; // User has complete attendance, skip
                }

                // Step 6: If only check-in exists but no check-out, update status
                if ($attendance->signing_in_date_time && !$attendance->signing_out_date_time) {
                    $attendance->update([
                        'status' => 'unknown',
                        'note' => 'Forgot To Give Check out'
                    ]);
                   // \Log::info("User {$user->id} forgot to check out on {$currentDate}. Updated status.");
                    continue;
                }
            }

            // Step 7: Check if user is on approved leave
            $onLeave = LeaveRequest::where('user_id', $user->id)
                ->whereDate('from_date', '<=', $currentDate)
                ->whereDate('to_date', '>=', $currentDate)
                ->where('status', 'approved')
                ->whereNull('deleted_at')
                ->exists();

            if ($onLeave) {
              //  \Log::info("User {$user->id} is on approved leave for {$currentDate}. Skipping.");
                continue;
            }

            // Step 8: Check if user is already marked absent
              $alreadyAbsent = Absent::where('user_id', $user->id)
                ->whereDate('from_date', '<=', $currentDate)
                ->whereDate('to_date', '>=', $currentDate)
                ->where('status', 'approved')
                ->whereNull('deleted_at')
                ->exists();

            if ($alreadyAbsent) {
               // \Log::info("User {$user->id} is already marked absent for {$currentDate}. Skipping.");
                continue;
            }

            // Step 9: If none of the above conditions match, mark user as absent
            $absent = Absent::create([
                'user_id' => $user->id,
                'from_date' => $currentDate,
                'to_date' => $currentDate,
                'total_days' => 1,
                'reason' => 'Missing Check in and Out',
                'status' => 'approved'
            ]);

          //  \Log::info("User {$user->id} marked absent for {$currentDate} - Missing Check in and Out.");

            // Step 10: Send notification to user for absent record
            $description = "You have been marked absent for {$currentDate} due to missing check-in and check-out.";

            UserNotification::create([
                'title' => 'Absent Created',
                'description' => $description,
                'link' => url('/absents/' . $absent->id),
                'type' => Absent::class,
                'user_id' => $user->id,
            ]);

           //  \Log::info("Notification sent to user {$user->id} for absent record on {$currentDate}");
        }

        \Log::info("Attendance job completed for date: {$currentDate}");
    }
}
