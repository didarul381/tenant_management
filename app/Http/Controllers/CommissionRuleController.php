<?php

namespace App\Http\Controllers;

use App\Models\CommissionRule;
use App\Models\Project;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CommissionRuleController extends Controller
{
    public function index()
    {
        $rules = CommissionRule::withCount(['projects', 'principalUsers', 'secondaryUsers'])
            ->orderByDesc('created_at')
            ->paginate(15);
        return view('commission_rules.index', compact('rules'));
    }

    public function create()
    {
        $projects = Project::orderBy('name')->get(['id','name']);
        $departments = Department::orderBy('name')->get(['id','name']);
        $usersByDept = [];
        foreach ($departments as $dept) {
            $usersByDept[$dept->name] = User::where('department_id', $dept->id)->orderBy('name')->get(['id','name']);
        }
        // Unassigned department users
        $unassignedUsers = User::whereNull('department_id')->orderBy('name')->get(['id','name']);
        if ($unassignedUsers->count()) {
            $usersByDept['Others'] = $unassignedUsers;
        }
        return view('commission_rules.create', compact('projects','departments','usersByDept'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'total_percentage' => 'required|integer|min:1|max:100',
            'principal_percentage' => 'required|integer|min:0|max:100',
            'secondary_percentage' => 'required|integer|min:0|max:100',
            'projects' => 'required|array|min:1',
            'principal_users' => 'required|array|min:1',
            'secondary_users' => 'required|array|min:1',
            'priority' => [
                'required','integer','min:1',
                Rule::unique('commission_rules','priority')->whereNull('deleted_at'),
            ],
        ], [
            'priority.unique' => 'Same priority cannot be used for multiple active rules.',
        ]);

        // Ensure sum percentages integrity if needed
        if ((int)$data['principal_percentage'] + (int)$data['secondary_percentage'] > (int)$data['total_percentage']) {
            return back()->withInput()->withErrors(['principal_percentage' => 'Principal + Secondary cannot exceed Total percentage']);
        }

        DB::transaction(function () use ($data) {
            $rule = CommissionRule::create([
                'total_percentage' => $data['total_percentage'],
                'principal_percentage' => $data['principal_percentage'],
                'secondary_percentage' => $data['secondary_percentage'],
                'priority' => $data['priority'],
                'created_by' => Auth::id(),
            ]);

            $rule->projects()->sync($data['projects']);
            $rule->principalUsers()->sync($data['principal_users']);
            $rule->secondaryUsers()->sync($data['secondary_users']);
        });

        return redirect()->route('commission-rules.index')->with('success', 'Commission Rule created successfully.');
    }

    public function show(CommissionRule $commission_rule)
    {
        $rule = $commission_rule->load(['projects','principalUsers','secondaryUsers']);
        return view('commission_rules.show', compact('rule'));
    }

    public function edit(CommissionRule $commission_rule)
    {
        $rule = $commission_rule->load(['projects','principalUsers','secondaryUsers']);
        $projects = Project::orderBy('name')->get(['id','name']);
        $departments = Department::orderBy('name')->get(['id','name']);
        $usersByDept = [];
        foreach ($departments as $dept) {
            $usersByDept[$dept->name] = User::where('department_id', $dept->id)->orderBy('name')->get(['id','name']);
        }
        $unassignedUsers = User::whereNull('department_id')->orderBy('name')->get(['id','name']);
        if ($unassignedUsers->count()) {
            $usersByDept['Others'] = $unassignedUsers;
        }
        return view('commission_rules.edit', compact('rule','projects','usersByDept'));
    }

    public function update(Request $request, CommissionRule $commission_rule)
    {
        $data = $request->validate([
            'total_percentage' => 'required|integer|min:1|max:100',
            'principal_percentage' => 'required|integer|min:0|max:100',
            'secondary_percentage' => 'required|integer|min:0|max:100',
            'projects' => 'required|array|min:1',
            'principal_users' => 'required|array|min:1',
            'secondary_users' => 'required|array|min:1',
            'priority' => [
                'required','integer','min:1',
                Rule::unique('commission_rules','priority')
                    ->ignore($commission_rule->id)
                    ->whereNull('deleted_at'),
            ],
        ], [
            'priority.unique' => 'Same priority cannot be used for multiple active rules.',
        ]);
        if ((int)$data['principal_percentage'] + (int)$data['secondary_percentage'] > (int)$data['total_percentage']) {
            return back()->withInput()->withErrors(['principal_percentage' => 'Principal + Secondary cannot exceed Total percentage']);
        }

        DB::transaction(function () use ($commission_rule, $data) {
            $commission_rule->update([
                'total_percentage' => $data['total_percentage'],
                'principal_percentage' => $data['principal_percentage'],
                'secondary_percentage' => $data['secondary_percentage'],
                'priority' => $data['priority'],
            ]);
            $commission_rule->projects()->sync($data['projects']);
            $commission_rule->principalUsers()->sync($data['principal_users']);
            $commission_rule->secondaryUsers()->sync($data['secondary_users']);
        });

        return redirect()->route('commission-rules.index')->with('success', 'Commission Rule updated successfully.');
    }

    public function destroy(CommissionRule $commission_rule)
    {
        $commission_rule->delete();
        return redirect()->route('commission-rules.index')->with('success', 'Commission Rule deleted successfully.');
    }
}
