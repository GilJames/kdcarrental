<?php

namespace App\Http\Livewire\IsAdmin;

use App\Models\User;
use Livewire\Component;

class BanuserComponent extends Component
{
    public function render()
    {
        $data = User::all();
        return view('livewire.is-admin.banuser-component', compact('data'))->layout('layouts.base');
    }
}
