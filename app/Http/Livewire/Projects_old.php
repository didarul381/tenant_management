<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\UserNotification;
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

    // Job type filter: 'all' | 'dm' (Digital Marketing) | 'ecs' (Ecommerce Saas) | 'cs' (Custom Software) | 'ihd' (In House Development) | 'non' (Others)
    public $digitalMarketing = 'all';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->paginate = 40;
        
        $projects = $this->searchProjects($this->client);
        $totalProjects = Project::count();

        return view('livewire.projects', [
            'projects' => $projects,
            'totalProjects' => $totalProjects,
        ])->with('search');
    }

    /**
     * @param $client
     * @return LengthAwarePaginator
     */
    public function searchProjects($client)
    {
        //old code before 20/1/2026
        // $this->setQuery($this->getQuery()->select('projects.*')->selectRaw('(SELECT MIN(due_date) FROM tasks WHERE tasks.project_id = projects.id AND tasks.status != ?) as earliest_due_date', [Task::STATUS_COMPLETED])->with([
        //     'client', 'tasks', 'users.media', 'createdUser', 'openTasks',
        // ])->orderBy('name', 'asc')->withCount([
        //     'tasks' => function ($query) {
        //         $query->where('status', '=', Task::$status['STATUS_ACTIVE']);
        //     }, 'users',
        // ])->orderBy('earliest_due_date', 'asc'));


        // modified code 20/1/2026 START
        $this->setQuery(
        $this->getQuery()
            ->select('projects.*')
            ->selectRaw('(SELECT MIN(due_date) FROM tasks WHERE tasks.project_id = projects.id AND tasks.status != ?) as earliest_due_date', [Task::STATUS_COMPLETED])
            ->with(['client', 'tasks', 'users.media', 'createdUser', 'openTasks'])
            ->withCount([
                'tasks' => function ($query) {
                    $query->where('status', '=', Task::$status['STATUS_ACTIVE']);
                }, 
                'users',
            ])
            ->orderByRaw('earliest_due_date IS NULL, earliest_due_date ASC')
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

        // Apply job type filter
        $this->getQuery()->when(true, function (Builder $q) {
            switch ($this->digitalMarketing) {
                case 'dm':
                    $q->where('is_digital_marketing', 1);
                    break;
                case 'ecs':
                    $q->where('is_ecommerce_saas', 1);
                    break;
                case 'cs':
                    $q->where('is_custom_software', 1);
                    break;
                case 'ihd':
                    $q->where('is_in_house_development', 1);
                    break;
                case 'non':
                    // Others = none of the four flags are true (1)
                    $q->where(function (Builder $sq) {
                        $sq->where(function (Builder $sqq) {
                            $sqq->whereNull('is_digital_marketing')
                                ->orWhere('is_digital_marketing', '!=', 1);
                        })
                        ->where(function (Builder $sqq) {
                            $sqq->whereNull('is_ecommerce_saas')
                                ->orWhere('is_ecommerce_saas', '!=', 1);
                        })
                        ->where(function (Builder $sqq) {
                            $sqq->whereNull('is_custom_software')
                                ->orWhere('is_custom_software', '!=', 1);
                        })
                        ->where(function (Builder $sqq) {
                            $sqq->whereNull('is_in_house_development')
                                ->orWhere('is_in_house_development', '!=', 1);
                        });
                    });
                    break;
                case 'all':
                default:
                    // no-op
                    break;
            }
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

    public function usersProject($id)
    {
        $this->userId = $id;
    }

    /**
     * @param $clientId
     */
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
