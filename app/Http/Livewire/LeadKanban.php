<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use App\Models\LeadStage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;

class LeadKanban extends Component
{
    public $allLeads = [];          // stage_id => collection of leads
    public $leadStages;
    public $userFilter;
    public $stageFilter;
    public $sourceFilter;
    public $dateRange;
    public $sortBy;

    public $offsets = [];           // stage_id => offset for pagination
    public $limit = 50;
    public $hasMore = [];            // number of leads per "Show More"

    protected $listeners = [
        'loadByStage',
        'loadByUser',
        'loadBySource',
        'loadByDateRange',
        'loadBySort',
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        // Load stages
        $this->leadStages = LeadStage::orderBy('sort_order', 'asc')->get();

        // Initialize offsets & empty lead collections
        foreach ($this->leadStages as $stage) {
           $this->offsets[$stage->id] = 0;
           $this->allLeads[$stage->id] = collect(); // <--- collection
           $this->loadMore($stage->id);
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.leads-kanban');
    }

    /**
     * Load more leads for a specific stage
     *
     * @param int $stageId
     * @return void
     */
    public function loadMore($stageId)
    {
        $query = Lead::with(['assignedUser', 'source', 'leadStage'])
            ->where('stage_id', $stageId);
    
        // Apply filters
        if (!empty($this->userFilter)) {
            $query->where('assigned_to', $this->userFilter);
        }
        if (!empty($this->sourceFilter)) {
            $query->where('source_id', $this->sourceFilter);
        }
        if (!empty($this->dateRange)) {
            [$start, $end] = explode(' - ', $this->dateRange);
            $query->whereBetween('created_at', [$start, $end]);
        }
    
        // Sorting
        if (!empty($this->sortBy)) {
            switch ($this->sortBy) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'recently-updated':
                    $query->orderBy('updated_at', 'desc');
                    break;
                case 'earliest-updated':
                    $query->orderBy('updated_at', 'asc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
    
        // --- Fetch with limit + 1 extra ---
        $leads = $query->skip($this->offsets[$stageId])
            ->take($this->limit + 1) // fetch one extra to check if more exists
            ->get();
    
        // Determine if there's more
        if ($leads->count() > $this->limit) {
            $this->hasMore[$stageId] = true;
            $leads = $leads->take($this->limit); // only keep limit
        } else {
            $this->hasMore[$stageId] = false;
        }
    
        // Merge with already loaded leads
        $this->allLeads[$stageId] = collect($this->allLeads[$stageId])->merge($leads);
    
        // Update offset
        $this->offsets[$stageId] += $this->limit;
    }

    

    public function loadByStage($stageId)
    {
        $this->stageFilter = $stageId;
        $this->resetStage($stageId);
    }

    public function loadByUser($userId)
    {
        $this->userFilter = $userId;
        $this->resetAllStages();
    }

    public function loadBySource($sourceId)
    {
        $this->sourceFilter = $sourceId;
        $this->resetAllStages();
    }

    public function loadByDateRange($range)
    {
        $this->dateRange = $range ?: null;
        $this->resetAllStages();
    }

    public function loadBySort($sort)
    {
        $this->sortBy = $sort ?: null;
        $this->resetAllStages();
    }

    /**
     * Reset leads and offset for all stages (used when filters change)
     */
    protected function resetAllStages()
    {
        foreach ($this->leadStages as $stage) {
            $this->resetStage($stage->id);
        }
    }

    /**
     * Reset leads and offset for a single stage
     */
    protected function resetStage($stageId)
    {
        $this->allLeads[$stageId] = collect();
        $this->offsets[$stageId] = 0;
        $this->loadMore($stageId);
    }
}
