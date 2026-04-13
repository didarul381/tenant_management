<?php

namespace App\Http\Controllers;

use App\Models\JobStatus;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Flash;
use Laracasts\Flash\Flash;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class JobStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = JobStatus::orderBy('created_at', 'desc')->get();
        return view('job-status.index', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:job_statuses,name',
                'description' => 'nullable|string',
                'order' => 'nullable|integer|unique:job_statuses,order',
            ]);

            JobStatus::create([
                'name' => $request->name,
                'description' => $request->description,
                'order' => $request->order ?? 0,
                'created_by' => auth()->id(),
            ]);
             // Check if request is AJAX
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Job Status Created successfully.'
                ]);
            }
            
            return redirect()->route('job-status.index')->with('success', 'Job status Created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobStatus $status)
    {
        // Check if request is AJAX
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $status,
                'message' => 'Job status data retrieved successfully'
            ]);
        }
        
       // return view('job-status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobStatus $status)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:job_statuses,name,' . $status->id,
                'description' => 'nullable|string',
                'order' => 'nullable|integer|unique:job_statuses,order,' . $status->id,
            ]);

            $status->update([
                'name' => $request->name,
                'description' => $request->description,
                'order' => $request->order ?? $status->order,
            ]);
            
            // Check if request is AJAX
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Job Status updated successfully.'
                ]);
            }
            
            return redirect()->route('job-status.index')->with('success', 'Job status updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
      public function sendError($message, $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], (int)$code);
    }
    public function destroy(JobStatus $status)
    {
        // Check if status is being used by any jobs
        $projectsCount = $status->projects()->count();
        
        if ($projectsCount > 0) {
            if (request()->ajax()) {
               return $this->sendError('Job Status can not be deleted.');
            }
        }
        
        $isAdmin = auth()->user()->hasRole('Admin');
        if($isAdmin){
            $status->delete();
            
            // Check if request is AJAX
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Job Status deleted successfully.'
                ]);
            }
            
            return redirect()->route('job-status.index')->with('success', 'Job status deleted successfully.');
        } else {
            if (request()->ajax()) {
                return $this->sendError('You do not have permission to delete Job Status.');
            }
           
            return redirect()->route('job-status.index');
        }
        
    }
}