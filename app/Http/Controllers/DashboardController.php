<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SatkerService;
use App\Exports\SatkerExport;
use App\Models\Satker;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    protected $satkerService;

    public function __construct(SatkerService $satkerService)
    {
        $this->satkerService = $satkerService;

    }

    public function index(Request $request)
    {
        $tahun = $request->input('tahun');
        $unit  = $request->input('unit');
        $satker = Satker::all();

        $satker = $this->satkerService->getFiltered($tahun, $unit);

        return view('backend.v_dashboard.index', compact('satker'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new SatkerExport($request->tahun, $request->unit),
            'satker.xlsx'
        );
    }

    public function exportCsv(Request $request)
    {
        return Excel::download(
            new SatkerExport($request->tahun, $request->unit),
            'satker.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }
}
