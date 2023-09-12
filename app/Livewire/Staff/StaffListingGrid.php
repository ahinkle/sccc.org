<?php

namespace App\Livewire\Staff;

use App\Models\Person;
use Illuminate\View\View;
use Livewire\Component;

class StaffListingGrid extends Component
{
    /**
     * Display the staff listing grid.
     */
    public function render(): View
    {
        return view('livewire.staff.staff-listing-grid', [
            'staff' => Person::staff()->get(),
        ]);
    }
}
