<?php

namespace App\View\Components\Staff;

use App\Models\Person;
use Illuminate\View\Component;
use Illuminate\View\View;

class StaffListingGrid extends Component
{
    public function render(): View
    {
        return view('components.staff.staff-listing-grid', [
            'staff' => Person::staff()->get(),
        ]);
    }
}
