<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\JobType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Str;

class Projects extends SearchableComponent
{
    use WithPagination;

    public $client = null;

    public $clientFilter = '';

    public $projectStatus = '1';

    public $userId = '';

    // Job type filter
    public $jobType = 'all';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->paginate = 40;
        
        $projects = $this->searchProjects($this->client);
        $totalProjects = Project::count();
        
        // Create dynamic status array with special cases
        $statusOptions = $this->getStatusOptions();
        
        // Get all clients for clone modal
        $clients = \App\Models\Client::orderBy('name')->get();
        
        // Get all users for clone modal
        $users = \App\Models\User::where('is_active', 1)->whereNull('deleted_at')->orderBy('name')->pluck('name', 'id')->toArray();
        
        // Get currencies for clone modal
        $currencies = \App\Models\Project::CURRENCY;
        
        // Get budget types for clone modal
        $budgetTypes = \App\Models\Project::BUDGET_TYPE;
        
        // Get job types for clone modal
        $types = JobType::orderByRaw('`order` = 0, `order` ASC')
                ->orderBy('created_at', 'desc')
                ->get();
        $jobTypes = $types->pluck('name', 'id')->toArray();

        // Simple status array for clone modal
        $projectStatus = [
            0 => 'All',
            1 => 'Ongoing',
            2 => 'Finished',
            3 => 'OnHold',
            4 => 'Archived',
            5 => 'Paid'
        ];

        return view('livewire.projects', [
            'projects' => $projects,
            'totalProjects' => $totalProjects,
            'statusOptions' => $statusOptions,
            'projectStatus' => $projectStatus, // Use simple status array
            'clients' => $clients,
            'users' => $users,
            'currencies' => $currencies,
            'budgetTypes' => $budgetTypes,
            'jobTypes' => $jobTypes,
        ])->with('search');
    }

    /**
     * Refresh projects list (called from JavaScript after clone)
     */
    public function refreshProjects()
    {
        // This method is called from JavaScript to refresh the component
        // The render() method will be called automatically
    }

    /**
     * Get status options with special handling for Paid and Due
     * Maintains serial order: All, Ongoing, Due, Paid, OnHold, Finished, Archived
     */
    private function getStatusOptions()
    {
        // Define the desired order
        $desiredOrder = [
            0 => 'All',
            1 => 'Ongoing',
            'due' => 'Due',
            'paid' => 'Paid',
            3 => 'OnHold',
            2 => 'Finished',
            4 => 'Archived'
        ];
        
        // Get all job statuses from database
        $dbStatuses = \App\Models\JobStatus::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        
        // Create final status array
        $finalStatuses = [];
        
        // Always start with 'All'
        $finalStatuses[0] = 'All';
        
        // Add statuses in desired order, excluding Paid and Due from database if they exist
        foreach ($desiredOrder as $key => $value) {
            if ($key === 0) continue; // Skip 'All' as it's already added
            
            // Check if this is a special case (Paid or Due)
            if ($key === 'due' || $key === 'paid') {
                $finalStatuses[$key] = $value;
            } else {
                // Check if this status exists in database (excluding Paid and Due)
                $statusExists = false;
                foreach ($dbStatuses as $dbId => $dbName) {
                    if (strtolower($dbName) === strtolower($value)) {
                        // Skip if it's Paid or Due (handled separately)
                        if (strtolower($dbName) !== 'paid' && strtolower($dbName) !== 'due') {
                            $finalStatuses[$dbId] = $dbName;
                            $statusExists = true;
                        }
                        break;
                    }
                }
                
                // If status doesn't exist in database, add any remaining statuses
                if (!$statusExists) {
                    // Add any database statuses not yet included (excluding Paid and Due)
                    foreach ($dbStatuses as $dbId => $dbName) {
                        if (strtolower($dbName) !== 'paid' && strtolower($dbName) !== 'due') {
                            if (!in_array($dbName, $finalStatuses)) {
                                $finalStatuses[$dbId] = $dbName;
                            }
                        }
                    }
                }
            }
        }
        
        // Add any remaining database statuses (excluding Paid and Due)
        foreach ($dbStatuses as $dbId => $dbName) {
            if (strtolower($dbName) !== 'paid' && strtolower($dbName) !== 'due') {
                if (!in_array($dbName, $finalStatuses)) {
                    $finalStatuses[$dbId] = $dbName;
                }
            }
        }
        
        return $finalStatuses;
    }

    /**
     * @param $client
     * @return LengthAwarePaginator
     */
    // public function searchProjects($client)
    // {
    //     //old code before 20/1/2026
    //     // $this->setQuery($this->getQuery()->select('projects.*')->selectRaw('(SELECT MIN(due_date) FROM tasks WHERE tasks.project_id = projects.id AND tasks.status != ?) as earliest_due_date', [Task::STATUS_COMPLETED])->with([
    //     //     'client', 'tasks', 'users.media', 'createdUser', 'openTasks',
    //     // ])->orderBy('name', 'asc')->withCount([
    //     //     'tasks' => function ($query) {
    //     //         $query->where('status', '=', Task::$status['STATUS_ACTIVE']);
    //     //     }, 'users',
    //     // ])->orderBy('earliest_due_date', 'asc'));


    //     // modified code 20/1/2026 START
    //     $this->setQuery(
    //     $this->getQuery()
    //         ->select('projects.*')
    //         ->selectRaw('(SELECT MIN(due_date) FROM tasks WHERE tasks.project_id = projects.id AND tasks.status != ?) as earliest_due_date', [Task::STATUS_COMPLETED])
    //         ->with(['client', 'tasks', 'users.media', 'createdUser', 'openTasks', 'type'])
    //         ->withCount([
    //             'tasks' => function ($query) {
    //                 $query->where('status', '=', Task::$status['STATUS_ACTIVE']);
    //             }, 
    //             'users',
    //         ])
    //         ->orderByRaw('earliest_due_date IS NULL, earliest_due_date ASC')
    // );
    // // modified code 20/1/2026 END

    //     $this->getQuery()->when(! empty($this->userId), function (Builder $q) {
    //         $this->getQuery()->whereHas('users', function (Builder $q) {
    //             $q->where('user_id', '=', $this->userId);
    //         });
    //     });
    //     $this->getQuery()->where(function (Builder $query) {
    //         if (empty($this->clientFilter)) {
    //             $this->filterResults();
    //         }
    //     });

    //     $this->getQuery()->when(! empty($this->clientFilter), function (Builder $q) {
    //         if (! empty($this->search)) {
    //             $searchString = '%'.$this->search.'%';
    //             $q->orWhereRaw('lower(name) like ?', $searchString);
    //         }
    //         $q->WhereHas('client', function (Builder $q) {
    //             $q->where('id', $this->clientFilter);
    //         });
    //     });

    //     $this->getQuery()->when(! empty($client), function (Builder $q) use ($client) {
    //         $q->WhereHas('client', function (Builder $q) use ($client) {
    //             $q->where('name', 'like', '%'.$client.'%');
    //         });
    //     });

    //     // Status filter, extended with payment-status: 'paid' and 'due'
    //     $this->getQuery()->when($this->projectStatus !== '' && $this->projectStatus !== null, function (Builder $q) {
    //         // If 'All' selected (0), do not filter by status
    //         if ((string)$this->projectStatus === '0') {
    //             return; // no-op
    //         }
            
    //         // Get all job statuses to check for special cases
    //         $allStatuses = \App\Models\JobStatus::pluck('name', 'id')->toArray();
            
    //         // Check if selected status is "Paid" or "Due" (special cases)
    //         if ($this->projectStatus === 'paid' || (string)$this->projectStatus === (string) \App\Models\Project::STATUS_PAID) {
    //             // Paid: project.price <= sum(approved invoices.paid)
    //             $q->whereRaw("(
    //                 SELECT COALESCE(SUM(pi.paid), 0)
    //                 FROM projects_invoice pi
    //                 WHERE pi.project_id = projects.id AND pi.status = 'approved'
    //             ) >= COALESCE(projects.price, 0)");
    //         } elseif ($this->projectStatus === 'due') {
    //             // Due: only consider projects with a positive price, and paid sum less than price
    //             $q->whereRaw('COALESCE(projects.price, 0) > 0');
    //             $q->whereRaw("(
    //                 SELECT COALESCE(SUM(pi.paid), 0)
    //                 FROM projects_invoice pi
    //                 WHERE pi.project_id = projects.id AND pi.status = 'approved'
    //             ) < COALESCE(projects.price, 0)");
    //         } else {
    //             // Default: filter by normal project status
    //             $q->where('status', $this->projectStatus);
    //         }
    //     });

    //     // Apply dynamic job type filter
    //     $this->getQuery()->when($this->jobType !== 'all', function (Builder $q) {
    //         $q->where('job_type', $this->jobType);
    //     });

    //     return $this->paginate($withoutSearching = false);
    // }
    
    // new code 01-03-2026
     public function searchProjects($client)
    {
       
        // modified code 20/1/2026 START
        $this->setQuery(
        $this->getQuery()
            ->select('projects.*')
            ->selectRaw('(SELECT MIN(due_date) FROM tasks WHERE tasks.project_id = projects.id AND tasks.status != ? AND tasks.deleted_at IS NULL) as earliest_due_date', [Task::STATUS_COMPLETED])
            ->with(['client', 'tasks', 'users.media', 'createdUser', 'openTasks', 'type'])
            ->withCount([
                'tasks' => function ($query) {
                    $query->where('status', '=', Task::$status['STATUS_ACTIVE']);
                }, 
                'users',
            ])
            // custom ordering based on earliest_due_date of incomplete tasks:
            // 0) overdue (date < today) first
            // 1) due today next
            // 2) future due
            // 3) projects with no incomplete tasks (earliest_due_date null) last, ordered by newest created
            ->orderByRaw("(CASE WHEN earliest_due_date < ? THEN 0 WHEN earliest_due_date = ? THEN 1 WHEN earliest_due_date > ? THEN 2 ELSE 3 END) ASC", [
                    \Carbon\Carbon::today()->format('Y-m-d'),
                    \Carbon\Carbon::today()->format('Y-m-d'),
                    \Carbon\Carbon::today()->format('Y-m-d'),
                ])
            // within each bucket, sort by the date itself (nulls last) and finally by creation for projects
            ->orderByRaw('earliest_due_date IS NULL, earliest_due_date ASC')
            ->orderBy('created_at', 'asc')
    );
    // modified code 20/1/2026 END

        $this->getQuery()->when(! empty($this->userId), function (Builder $q) {
            $this->getQuery()->whereHas('users', function (Builder $q) {
                $q->where('user_id', '=', $this->userId);
            });
        });
        $this->getQuery()->where(function (Builder $query) {
            if (empty($this->clientFilter)) {
                $this->filterResults();
            }
        });

        $this->getQuery()->when(! empty($this->clientFilter), function (Builder $q) {
            if (! empty($this->search)) {
                $searchString = '%'.$this->search.'%';
                $q->orWhereRaw('lower(name) like ?', $searchString);
            }
            $q->WhereHas('client', function (Builder $q) {
                $q->where('id', $this->clientFilter);
            });
        });

        $this->getQuery()->when(! empty($client), function (Builder $q) use ($client) {
            $q->WhereHas('client', function (Builder $q) use ($client) {
                $q->where('name', 'like', '%'.$client.'%');
            });
        });

        // Status filter, extended with payment-status: 'paid' and 'due'
        $this->getQuery()->when($this->projectStatus !== '' && $this->projectStatus !== null, function (Builder $q) {
            // If 'All' selected (0), do not filter by status
            if ((string)$this->projectStatus === '0') {
                return; // no-op
            }
            
            // Get all job statuses to check for special cases
            $allStatuses = \App\Models\JobStatus::pluck('name', 'id')->toArray();
            
            // Check if selected status is "Paid" or "Due" (special cases)
            if ($this->projectStatus === 'paid' || (string)$this->projectStatus === (string) \App\Models\Project::STATUS_PAID) {
                // Paid: project.price <= sum(approved invoices.paid)
                $q->whereRaw("(
                    SELECT COALESCE(SUM(pi.paid), 0)
                    FROM projects_invoice pi
                    WHERE pi.project_id = projects.id AND pi.status = 'approved'
                ) >= COALESCE(projects.price, 0)");
            } elseif ($this->projectStatus === 'due') {
                // Due: only consider projects with a positive price, and paid sum less than price
                $q->whereRaw('COALESCE(projects.price, 0) > 0');
                $q->whereRaw("(
                    SELECT COALESCE(SUM(pi.paid), 0)
                    FROM projects_invoice pi
                    WHERE pi.project_id = projects.id AND pi.status = 'approved'
                ) < COALESCE(projects.price, 0)");
            } else {
                // Default: filter by normal project status
                $q->where('status', $this->projectStatus);
            }
        });

        // Apply dynamic job type filter
        $this->getQuery()->when($this->jobType !== 'all', function (Builder $q) {
            $q->where('job_type', $this->jobType);
        });

        return $this->paginate($withoutSearching = false);
    }

    protected $listeners = [
        'refresh' => '$refresh',
        'filterProjects',
        'projectsStatus',
        'usersProject',
        'updateAssigneesProject',
    ];

    public function updatedDigitalMarketing()
    {
        $this->resetPage();
    }

    /**
     * @param $status
     */
    public function projectsStatus($status)
    {
        $this->projectStatus = $status;
    }

    /**
     * @param $jobType
     */
    public function jobTypeFilter($jobType)
    {
        $this->jobType = $jobType;
        $this->resetPage();
    }

    public function usersProject($id)
    {
        $this->userId = $id;
    }

    public function filterProjects($clientId)
    {
        $this->clientFilter = $clientId;
        $this->resetPage();
    }

    public function model()
    {
        return Project::class;
    }

    public function searchableFields()
    {
        return [
            'name',
            'prefix',
            'client.name',
        ];
    }

    /**
     * @param $input
     * @param $id
     */
    public function updateAssigneesProject($input, $id)
    {
        $project = Project::with('users')->findOrFail($id);
        $assignees = ! empty($input) ? $input : $input = getLoggedInUserId();
        $oldUserIds = $project->users->pluck('id')->toArray();
        $project->users()->sync($assignees);

        if (is_array($input)) {
            $userIds = array_diff($assignees, $oldUserIds);
            $removedUserIds = array_diff($oldUserIds, $assignees);
            $users = User::whereIn('id', $userIds)->get();
            if ($users->count() > 0) {
                $u = [];
                foreach ($users as $user) {
                    array_push($u, $user->name);
                    UserNotification::create([
                        'title' => 'New Project Assigned',
                        'description' => $project->name.' assigned to you',
                        'link' => url('/projects/' . $project->id),
                        'type' => Project::class,
                        'user_id' => $user->id,
                    ]);
                }
                activity()
                    ->causedBy(getLoggedInUser())
                    ->withProperties(['modal' => Project::class, 'data' => ''])
                    ->performedOn($project)
                    ->useLog('Project Assignee Updated')
                    ->log('Assigned '.$project->name.' to '.implode(',', $u));
            }
            if (! empty($removedUserIds)) {
                foreach ($removedUserIds as $removedUser) {
                    UserNotification::create([
                        'title' => 'Removed From Project',
                        'description' => 'You removed from '.$project->name,
                        'link' => url('/projects/' . $project->id),
                        'type' => Project::class,
                        'user_id' => $removedUser,
                    ]);
                }
            }
        }
    }

    public function filterResults()
    {
        $searchableFields = $this->searchableFields();
        $search = $this->search;

        $this->getQuery()->when(! empty($search), function (Builder $q) use ($search, $searchableFields) {
            $this->getQuery()->where(function (Builder $q) use ($search, $searchableFields) {
                $searchString = '%'.$search.'%';
                foreach ($searchableFields as $field) {
                    if (Str::contains($field, '.')) {
                        $field = explode('.', $field);
                        $q->orWhereHas($field[0], function (Builder $query) use ($field, $searchString) {
                            $query->whereRaw("lower($field[1]) like ?", $searchString);
                        });
                    } else {
                        $q->orWhereRaw("lower($field) like ?", $searchString);
                    }
                }
            });
        });

        return $this->getQuery();
    }
}
