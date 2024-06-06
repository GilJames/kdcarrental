<?php

namespace App\Http\Livewire\IsAdmin;

use App\Models\Booking;
use App\Models\Selfdrive;
use Livewire\Component;

class CarReportsComponent extends Component
{
    public function render()
    {   
        $withdrive = Booking::where('status', 'completed')->get();
        $selfdrive = Selfdrive::where('status', 'completed')->get();

        $reports = $withdrive->concat($selfdrive)->sortBy('pickupdate');

        
        return view('livewire.is-admin.car-reports-component', compact('reports'))->layout('layouts.base');
    }
}
