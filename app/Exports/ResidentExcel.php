<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ResidentExcel implements FromView
{
    public function __construct($resident)
    {
        $this->resident = $resident;
    }

    public function view(): View
    {
        return view('exports.resident_excel', [
            'resident' => $this->resident
        ]);
    }
}
