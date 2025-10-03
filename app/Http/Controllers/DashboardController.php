<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SatkerService;
use App\Exports\SatkerExport;
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
        $bulan = $request->input('bulan');
        $unit  = $request->input('unit');

        $satker = $this->satkerService->getAll();
        $satker = $this->satkerService->getFiltered($tahun, $bulan, $unit);

        return view('backend.v_dashboard.index', compact('satker'));
    }

     public function exportExcel(Request $request)
    {
        return Excel::download(
            new SatkerExport($request->tahun,$request->bulan,$request->unit),
            'satker.xlsx'
        );
    }

    public function exportCsv(Request $request)
    {
        return Excel::download(
            new SatkerExport($request->tahun,$request->bulan,$request->unit),
            'satker.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

}
