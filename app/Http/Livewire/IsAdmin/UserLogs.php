<?php

namespace App\Http\Livewire\IsAdmin;

use App\Models\AdminActivityLog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UserLogs extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $selected = null;
    public $activityLogType = 'user'; 
    public $searchTerm = ''; 

    public function render()
    {
        $activityLog = ($this->activityLogType === 'user') ? 
        DB::table('activity_logs')->where(function ($query) {
            $query->where('name', 'like', "%$this->searchTerm%")
                ->orWhere('email', 'like', "%$this->searchTerm%")
                ->orWhere('description', 'like', "%$this->searchTerm%");
        })->paginate(10) : 
        AdminActivityLog::where(function ($query) {
            $query->where('name', 'like', "%$this->searchTerm%")
                ->orWhere('email', 'like', "%$this->searchTerm%")
                ->orWhere('description', 'like', "%$this->searchTerm%");
        })->paginate(10);
    

        return view('livewire.is-admin.user-logs', [
            'activityLog' => $activityLog,
        ])->layout('layouts.base');
    }

    public function updatedSelected($model)
    {
        $this->activityLogType = $model;
    }
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
}
