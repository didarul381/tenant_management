<?php

namespace App\Http\Livewire;

use App\Models\JobType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class JobTypes extends SearchableComponent
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
        $type = $this->searchProject();
       $totalType = JobType::count();

        return view('livewire.job-types', [
            'type' => $type,
            'totalType' =>$totalType,
        ])->with('search');
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchProject()
    {
        // $this->setQuery($this->getQuery()->orderByDesc('created_at'));
        $this->setQuery(
        $this->getQuery()
            ->orderByRaw('`order` = 0')
            ->orderBy('order', 'asc')
            ->orderByDesc('created_at')
        );

        return $this->paginate();
    }

    public function model()
    {
        return JobType::class;
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