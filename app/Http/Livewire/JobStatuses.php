<?php

namespace App\Http\Livewire;

use App\Models\JobStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class JobStatuses extends SearchableComponent
{
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $status = $this->searchProject();
        $totalStatus = JobStatus::count();

        return view('livewire.job-statuses', [
            'status' => $status,
            'totalStatus' => $totalStatus,
        ])->with('search');
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchProject()
    {
        $this->setQuery($this->getQuery()->orderByRaw('CASE WHEN `order` > 0 THEN 0 ELSE 1 END, `order` ASC, `created_at` DESC'));

        return $this->paginate();
    }

    public function model()
    {
        return JobStatus::class;
    }

    /**
     * @var string[]
     */
    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function searchableFields()
    {
        return [
            'name',
        ];
    }
}
