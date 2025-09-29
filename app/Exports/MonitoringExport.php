<?php

namespace App\Exports;

use App\Models\Monitoring;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonitoringExport implements FromView
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = Monitoring::query();

        if (!empty($this->filters['tahun'])) {
            $query->whereYear('created_at', $this->filters['tahun']);
        }

        if (!empty($this->filters['unit'])) {
            $query->where('unit', $this->filters['unit']);
        }

        return view('backend.v_dashboard.export', [
            'data' => $query->get()
        ]);
    }
}
