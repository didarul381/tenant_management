<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Tags extends SearchableComponent
{
    public $departmentFilter = '';
    public $statusFilter = '';

    public function mount()
    {
        $this->departmentFilter = request('department_filter', 'all');
        $this->statusFilter = request('status_filter', 'all');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDepartmentFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
       $this->paginate = 40;
        $tags = $this->searchProject();
        $totalFiltered = $tags->total();
        $totalTags = Tag::count();

        return view('livewire.tags', [
            'tags' => $tags,
            'totalTags' => $totalTags,
            'totalFiltered' => $totalFiltered,
        ])->with('search');
    }

    protected $listeners = ['refresh' => '$refresh'];

    /**
     * @return LengthAwarePaginator
     */
    public function searchProject()
    {
        $query = $this->getQuery();

        if ($this->departmentFilter === 'non_departmental') {
            $query->whereDoesntHave('departments');
        } elseif ($this->departmentFilter !== 'all' && is_numeric($this->departmentFilter)) {
            $query->whereHas('departments', function ($q) {
                $q->where('departments.id', $this->departmentFilter);
            });
        }

        if ($this->statusFilter !== 'all') {
            $query->where('is_active', $this->statusFilter);
        }

        $this->setQuery($query->orderByDesc('created_at'));

        return $this->paginate();
    }

    public function model()
    {
        return Tag::class;
    }

    public function searchableFields()
    {
        return [
            'name',
        ];
    }

    /**
     * @return Builder
     */
    protected function filterResults()
    {
        $searchableFields = $this->searchableFields();
        $search = $this->search;

        $query = $this->getQuery();
        $query->when(! empty($search), function (Builder $q) use ($search, $searchableFields) {
            $q->where(function ($query) use ($search, $searchableFields) {
                $searchString = '%'.$search.'%';
                foreach ($searchableFields as $field) {
                    if (Str::contains($field, '.')) {
                        $field = explode('.', $field);
                        $query->orWhereHas($field[0], function (Builder $subQuery) use ($field, $searchString) {
                            $subQuery->whereRaw("lower($field[1]) like ?", $searchString);
                        });
                    } else {
                        $query->orWhereRaw("lower($field) like ?", $searchString);
                    }
                }
            });
        });
        $this->setQuery($query);

        return $query;
    }
}
