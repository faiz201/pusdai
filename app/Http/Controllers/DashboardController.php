<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monitoring; // model data tabel kamu
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MonitoringExport;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->input('tahun');
        $seksi = $request->input('seksi');

        $data = Monitoring::query();

        if ($tahun) {
            $data->whereYear('created_at', $tahun);
        }

        if ($seksi) {
            $data->where('seksi', $seksi);
        }

        $data = $data->get();

        return view('backend.v_dashboard.index', compact('data', 'tahun', 'seksi'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new MonitoringExport($request->all()), 'monitoring.xlsx');
    }

    public function exportCsv(Request $request)
    {
        return Excel::download(new MonitoringExport($request->all()), 'monitoring.csv');
    }
}