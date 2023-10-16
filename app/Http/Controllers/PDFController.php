<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Karriere\PdfMerge\PdfMerge;

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
        $pdfName = "$survey->pangkat - $survey->nama";



        // Menggabungkan PDF dengan COVER.pdf
        $coverPath = public_path('assets/pdf/COVER.pdf');

        $pdfMerge = new PdfMerge();
        $pdfMerge->add($coverPath);

        // PDF Utama
        $pdf_utama = $this->pdf_utama($data);
        $pdfMerge->add($pdf_utama);
      
        // PDF Narasi Online
        $pdf_narasi_online = $this->pdf_narasi_online($data);
        $pdfMerge->add($pdf_narasi_online);
        
        // // PDF Keluarga
        // $pdf_keluarga = $this->pdf_keluarga($data);
        // $pdfMerge->add($pdf_keluarga);

        $mergedPdfOutput = storage_path('temp/merged_' . $pdfName . '.pdf');
        $pdfMerge->merge($mergedPdfOutput);

        // Return untuk download
        return response()->download($mergedPdfOutput, $pdfName . '.pdf')->deleteFileAfterSend(true);
    }

    protected function pdf_narasi_online($data)
    {
        // Membuat PDF dari view
        $pdf = Pdf::loadView('pdf.survey.narasi_online', $data);

        // Memastikan direktori temp ada
        if (!File::exists(storage_path('temp'))) {
            File::makeDirectory(storage_path('temp'), 0755, true);
        }

        // Simpan PDF ke sementara
        $tempPath = storage_path('temp/' . 'pdf_narasi_online' . '.pdf');
        file_put_contents($tempPath, $pdf->output());
        return $tempPath;
    }
    
    protected function pdf_keluarga($data)
    {
        // Membuat PDF dari view
        $pdf = Pdf::loadView('pdf.survey.keluarga', $data);

        // Memastikan direktori temp ada
        if (!File::exists(storage_path('temp'))) {
            File::makeDirectory(storage_path('temp'), 0755, true);
        }

        // Simpan PDF ke sementara
        $tempPath = storage_path('temp/' . 'pdf_keluarga' . '.pdf');
        file_put_contents($tempPath, $pdf->output());
        return $tempPath;
    }
    
    protected function pdf_utama($data)
    {
        // Membuat PDF dari view
        $pdf = Pdf::loadView('pdf.survey.hasil', $data);

        // Memastikan direktori temp ada
        if (!File::exists(storage_path('temp'))) {
            File::makeDirectory(storage_path('temp'), 0755, true);
        }

        // Simpan PDF ke sementara
        $tempPath = storage_path('temp/' . 'pdf_utama' . '.pdf');
        file_put_contents($tempPath, $pdf->output());
        return $tempPath;
    }

    public function preview_formulir($id)
    {
        // Ambil data survey beserta relasinya dari database
        $survey = Survey::with(['tarunaPhotos', 'baktiPhotos', 'berkaryaPhotos'])->find($id);
        $data = [
            'title' => 'Alumni',
            'survey' => $survey
        ];

        return view('pdf.survey.narasi_online', $data);
    }


    /* public function download($id)
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
    } */
}
