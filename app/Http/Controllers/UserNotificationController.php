<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class UserNotificationController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|JsonResponse|View
     */
    public function index()
    {
        $notifications = UserNotification::whereUserId(\Auth::id())->where('read_at',
            null)->orderByDesc('created_at')->get();

        return $this->sendResponse($notifications, 'Notification retrieved successfully');
    }

    /**
     * @param  UserNotification  $notification
     * @return JsonResponse
     */
    public function readNotification(UserNotification $notification)
    {
        $notification->read_at = Carbon::now();
        $notification->save();

        return $this->sendSuccess('Notification read successfully.');
    }

    /**
     * Send notifications for a given project to selected users.
     *
     * @param \App\Models\Project $project
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function sendProjectNotification(\App\Models\Project $project, \Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'integer|exists:users,id',
            'message' => 'nullable|string|max:5000',
        ]);

        $title = 'New Project Assigned';
        $type = \App\Models\Project::class;
        $fallback = 'You are assigned to ' . $project->name;
        $desc = !empty($data['message']) ? $data['message'] : $fallback;

        foreach ($data['user_ids'] as $uid) {
            UserNotification::create([
                'title' => $title,
                'type' => $type,
                'description' => $desc,
                'link' => url('/projects/' . $project->id),
                'user_id' => (int) $uid,
            ]);
        }

        return $this->sendSuccess('Notifications sent successfully.');
    }

    /**
     * @return JsonResponse
     */
    public function readAllNotification()
    {
        UserNotification::whereReadAt(null)->where('user_id',
            getLoggedInUserId())->update(['read_at' => Carbon::now()]);

        return $this->sendSuccess('All Notification read successfully.');
    }
}
