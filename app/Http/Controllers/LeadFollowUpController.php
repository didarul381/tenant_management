<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\LeadFollowUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadFollowUpController extends Controller
{
   
    public function store(Request $request)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
            'follow_up_at' => 'required|date',
            'type' => 'required|in:call,email,meeting,sms,other',
            'status' => 'required|in:pending,completed,canceled,rescheduled',
            'note' => 'nullable|string|max:1000',
        ]);

        try {
            $followUp = LeadFollowUp::create([
                'lead_id'      => $request->lead_id,
                'assigned_to'  => $request->assigned_to,
                'follow_up_at' => $request->follow_up_at,
                'type'         => $request->type,
                'status'       => $request->status,
                'note'         => $request->note,
                'created_by'   => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => __('messages.leads.followup_created'),
                'data'    => $followUp,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. '.$e->getMessage(),
            ], 500);
        }
    }



    // Show modal form for editing a follow-up
    public function edit(LeadFollowUp $lead_followup)
    {
        $users = User::pluck('name', 'id'); 

        $assignedUser = $lead_followup->assigned_to;

        return response()->json([
            'success' => true,
            'message' => 'Follow-up retrieved successfully.',
            'data' => [
                'followUp' => $lead_followup,
                'assignedUser' => $assignedUser,
                'users' => $users
            ]
        ]);
    }




    // Update a follow-up
    public function update(LeadFollowUp $lead_followup, Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'assigned_to'  => 'required|exists:users,id',
            'follow_up_at' => 'required|date',
            'type'         => 'required|string',
            'status'       => 'required|string',
            'note'         => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $input = $request->all();

        // Optional: parse follow_up_at
        $input['follow_up_at'] = \Carbon\Carbon::parse($input['follow_up_at'])->format('Y-m-d H:i:s');

        // Update the follow-up
        $lead_followup->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Follow-up updated successfully.'
        ]);
    }

    public function destroy(LeadFollowUp $lead_followup)
    {  
        $lead_followup->delete(); // or your custom logic
        return response()->json(['success' => true, 'message' => 'Follow-up deleted successfully.']);
    }



}
