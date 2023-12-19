<?php

namespace App\Http\Controllers;

use App\Exports\FormulirExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportFormulir(Request $request)
    {
        $export_date_encoded = $request->input('export_date');
        $export_date = null;
        $startDate = null;
        $endDate = null;

        if ($export_date_encoded) {
            $export_date = base64_decode($export_date_encoded);
            [$startDate, $endDate] = explode(' - ', $export_date);

            $startDate = Carbon::createFromFormat('m/d/Y', $startDate);
            $endDate = Carbon::createFromFormat('m/d/Y', $endDate);
        }

        $fileName = 'Hasil Pengisian Formulir Bulan ' . now()->format('F Y') . '.xlsx';
        return Excel::download(new FormulirExport($startDate, $endDate), $fileName);
    }
}
