<?php

namespace App\Livewire\Alumni;

use App\Models\AlumniProfile;
use Livewire\Component;
use Livewire\WithPagination;

class Directory extends Component
{
    use WithPagination;

    public $search = '';
    public $yearFilter = '';
    public $departmentFilter = '';
    public $cityFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'yearFilter' => ['except' => ''],
        'departmentFilter' => ['except' => ''],
        'cityFilter' => ['except' => ''],
    ];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedYearFilter(): void
    {
        $this->resetPage();
    }

    public function updatedDepartmentFilter(): void
    {
        $this->resetPage();
    }

    public function updatedCityFilter(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->yearFilter = '';
        $this->departmentFilter = '';
        $this->cityFilter = '';
        $this->resetPage();
    }

    public function render()
    {
        $query = AlumniProfile::query()
            ->where('verified', true)
            ->when($this->search, function ($q) {
                $q->where(function ($subQ) {
                    $subQ->where('full_name', 'like', "%{$this->search}%")
                        ->orWhere('current_job', 'like', "%{$this->search}%")
                        ->orWhere('bio', 'like', "%{$this->search}%");
                });
            })
            ->when($this->yearFilter, function ($q) {
                $q->where('graduation_year', $this->yearFilter);
            })
            ->when($this->departmentFilter, function ($q) {
                $q->where('department', $this->departmentFilter);
            })
            ->when($this->cityFilter, function ($q) {
                $q->where('city', 'like', "%{$this->cityFilter}%");
            });

        $alumni = $query->with('user')->paginate(12);

        $departments = AlumniProfile::distinct()->pluck('department')->sort()->filter()->values();
        $years = AlumniProfile::distinct()->pluck('graduation_year')->sort()->reverse()->filter()->values();
        $cities = AlumniProfile::distinct()->pluck('city')->sort()->filter()->values();

        return view('livewire.alumni.directory', compact('alumni', 'departments', 'years', 'cities'));
    }
}
