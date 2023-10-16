<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function download($id)
    {
         // Ambil data survey beserta relasinya dari database
        $survey = Survey::with(['tarunaPhotos', 'baktiPhotos', 'berkaryaPhotos'])->find($id);
        $data = [
            'title' => 'Alumni',
            'survey' => $survey
        ];
        // Membuat PDF dari view
        $pdf = Pdf::loadView('pdf.survey.hasil', $data);
        $pdfName = "$survey->pangkat - $survey->nama";
        // $pdf->output();
        return $pdf->download($pdfName);
    }
}
