<?php

namespace App\Http\Controllers;

use App\Exports\FormulirExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportFormulir()
    {
        $fileName = 'Hasil Pengisian Formulir Bulan ' . now()->format('F Y') . '.xlsx';
        return Excel::download(new FormulirExport, $fileName);
    }
}
