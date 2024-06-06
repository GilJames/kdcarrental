<?php

namespace App\Http\Livewire\IsAdmin;

use App\Models\Feedback;
use Livewire\Component;
use Livewire\WithPagination;

class FeedbackReportsComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;


    public function render()
    {

        Feedback::query()->update(['status' => null]);
        $feedbacks = Feedback::orderBy('created_at', 'DESC')
            ->whereHas('user', function ($userQuery) {
                $userQuery->where('name', 'like', "%$this->searchTerm%");
    })
            ->orWhereHas('admincar', function ($admincarQuery) {
                $admincarQuery->where('carname', 'like', "%$this->searchTerm%")
                            ->orWhere('comment', 'like', "%$this->searchTerm%")
                            ->orWhere('updated_at', 'like', "%$this->searchTerm%");
            })
            ->paginate(10);


        return view('livewire.is-admin.feedback-reports-component', compact('feedbacks'))->layout('layouts.base');
    }
}
