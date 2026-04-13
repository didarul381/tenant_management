<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Flash;
use Laracasts\Flash\Flash;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = JobType::orderByRaw('`order` = 0, `order` ASC')
                ->orderBy('created_at', 'desc')
                ->get();
        // return $types;
        return view('job-type.index', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_types,name',
            //'color' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|unique:job_types,order',
        ]);

        JobType::create([
            'name' => $request->name,
            //'color' => $request->color ?? '#6c757d',
            'description' => $request->description,
           'order' => $request->order ?? 0,
            'created_by' => auth()->id(),
        ]);
         // Check if request is AJAX
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Job type Created successfully.'
            ]);
        }
        
        return redirect()->route('job-type.index')->with('success', 'Job type Created successfully.');
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobType $type)
    {
        // Check if request is AJAX
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $type,
                'message' => 'Job type data retrieved successfully'
            ]);
        }
        
       // return view('job-type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobType $type)
    {
         
        $request->validate([
            'name' => 'required|string|max:255|unique:job_types,name,' . $type->id,
           // 'color' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|unique:job_types,order,' . $type->id,
        ]);

        $type->update([
            'name' => $request->name,
            //'color' => $request->color ?? $type->color,
            'description' => $request->description,
           'order' => $request->order ?? $type->order,
        ]);
        
        // Check if request is AJAX
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Job type updated successfully.'
            ]);
        }
        
        return redirect()->route('job-type.index')->with('success', 'Job type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
      public function sendError($message, $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }
    public function destroy(JobType $type)
    {
        // Check if type is being used by any jobs
        $projectsCount = $type->projects()->count();
        
        if ($projectsCount > 0) {
            if (request()->ajax()) {
               return $this->sendError('Job type can not be deleted.');
            }
        }
        
        $isAdmin = auth()->user()->hasRole('Admin');
        if($isAdmin){
            $type->delete();
            
            // Check if request is AJAX
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Job type deleted successfully.'
                ]);
            }
            
            return redirect()->route('job-type.index')->with('success', 'Job type deleted successfully.');
        } else {
            if (request()->ajax()) {
                return $this->sendError('You do not have permission to delete Job type.');
            }
           
            return redirect()->route('job-type.index');
        }
        
    }
}