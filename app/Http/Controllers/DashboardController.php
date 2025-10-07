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
        $nama_satker  = $request->input('satker');

        $satker = $this->satkerService->getAll();
        return view('backend.v_dashboard.index', compact('satker'));
    }

     public function exportExcel(Request $request)
    {
        return Excel::download(
            new SatkerExport($request->tahun,$request->bulan,$request->satker),
            'satker.xlsx'
        );
    }

    public function exportCsv(Request $request)
    {
        return Excel::download(
            new SatkerExport($request->tahun,$request->bulan,$request->satker),
            'satker.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

}
