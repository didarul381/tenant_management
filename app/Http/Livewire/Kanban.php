<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\Status;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;

class Kanban extends Component
{
    public $allTasks = [];       // status => collection of tasks
    public $taskStatus;          // all statuses
    public $project = null;
    public $userFilter = null;

    public $offsets = [];        // status => offset for pagination
    public $limit = 50;
    public $hasMore = [];        // status => bool

    protected $listeners = [
        'loadByProject',
        'loadByUser',
        'refresh' => '$refresh',
    ];

    public function mount($projectId = null)
    {
        $this->project = $projectId;

        // Load statuses
        $this->taskStatus = Status::orderBy('order', 'ASC')->get();

        // Initialize offsets & empty task collections
        foreach ($this->taskStatus as $status) {
            $this->offsets[$status->status] = 0;
            $this->allTasks[$status->status] = collect();
            $this->loadMore($status->status);
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.kanban');
    }

    /**
     * Load tasks query for a specific status
     */
    protected function getTaskQuery($status): Builder
    {
        $query = Task::with(['taskAssignee', 'comments', 'media'])
            ->where('status', $status);

        if ($this->project) {
            $query->where('project_id', $this->project);
        }

        if ($this->userFilter) {
            $query->whereHas('taskAssignee', function (Builder $q) {
                $q->where('user_id', $this->userFilter);
            });
        }

        return $query->orderBy('id', 'desc');
    }

    /**
     * Load more tasks for a specific status
     */
    public function loadMore($status)
    {
        if (!isset($this->allTasks[$status])) {
            $this->allTasks[$status] = collect();
        }

        $offset = $this->offsets[$status] ?? 0;

        $tasks = $this->getTaskQuery($status)
                      ->skip($offset)
                      ->take($this->limit + 1) // fetch one extra to check if more exists
                      ->get();

        if ($tasks->count() > $this->limit) {
            $this->hasMore[$status] = true;
            $tasks = $tasks->take($this->limit); // only keep limit
        } else {
            $this->hasMore[$status] = false;
        }

        // Merge new tasks into existing collection
        $this->allTasks[$status] = collect($this->allTasks[$status])->merge($tasks);

        // Update offset
        $this->offsets[$status] = ($this->offsets[$status] ?? 0) + $this->limit;
    }

    public function loadByProject($projectId)
    {
        $this->project = $projectId;
        $this->resetAllStatuses();
    }

    public function loadByUser($userId)
    {
        $this->userFilter = $userId;
        $this->resetAllStatuses();
    }

    protected function resetAllStatuses()
    {
        foreach ($this->taskStatus as $status) {
            $this->allTasks[$status->status] = collect();
            $this->offsets[$status->status] = 0;
            $this->loadMore($status->status);
        }
    }
}
