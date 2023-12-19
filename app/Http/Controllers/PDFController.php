<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Karriere\PdfMerge\PdfMerge;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\File;

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
        $simpleName = Str::slug("$survey->pangkat $survey->nama");
        $pdfName = "$survey->pangkat - $survey->nama";

        // Menggabungkan PDF dengan COVER.pdf
        $coverPath = public_path('assets/pdf/COVER.pdf');

        $pdfMerge = new PdfMerge();
        $pdfMerge->add($coverPath);

        // PDF Utama
        $pdf_profil = $this->pdf_profil($data);
        $pdfMerge->add($pdf_profil);

        // $pdf_utama = $this->pdf_utama($data);    
        // $pdfMerge->add($pdf_utama);

        // PDF Narasi Online
        $pdf_narasi_online = $this->pdf_narasi_online($data);
        $pdfMerge->add($pdf_narasi_online);

        // PDF Keluarga
        $pdf_keluarga = $this->pdf_keluarga($data);
        $pdfMerge->add($pdf_keluarga);

        // PDF Daftar Anak
        $pdf_daftar_anak = $this->pdf_daftar_anak($data);
        $pdfMerge->add($pdf_daftar_anak);

        // PDF Bakti Akpol
        $pdf_bakti_akpol = $this->pdf_bakti_akpol($data);
        $pdfMerge->add($pdf_bakti_akpol);

        // PDF Bakti Berkarya
        $pdf_berkarya = $this->pdf_berkarya($data);
        $pdfMerge->add($pdf_berkarya);

        // Cek direktori temp ada
        $directoryPath = storage_path('temp');
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        $mergedPdfOutput = storage_path('temp/merged_' . $simpleName . '.pdf');
        $pdfMerge->merge($mergedPdfOutput);

        $compressedPdfOutput = storage_path('temp/compressed_' . $simpleName . '.pdf');
        $command = "gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook -dNOPAUSE -dQUIET -dBATCH -sOutputFile={$compressedPdfOutput} {$mergedPdfOutput}";
        shell_exec($command);

        // Return untuk download
        return response()->download($compressedPdfOutput, $pdfName . '.pdf')->deleteFileAfterSend(true);
    }

    protected function pdf_berkarya($data)
    {
        // Memastikan direktori temp ada
        if (!File::exists(storage_path('temp'))) {
            File::makeDirectory(storage_path('temp'), 0755, true);
        }

        $survey = $data['survey'];
        $paths = $survey->berkaryaPhotos->pluck('path')->toArray();
        $send = [
            'paths' => $paths,
            'survey' => $survey
        ];
        $html = view('pdf.survey.berkarya', $send)->render();

        // Simpan PDF ke sementara
        $tempPath = storage_path('temp/' . 'pdf_berkarya' . '.pdf');
        // file_put_contents($tempPath, $pdf->output());
        BrowserShot::html($html)->showBackground()
            ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
            ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
            ->margins(0, 0, 0, 0)->format('A4')
            ->savePdf($tempPath);
        return $tempPath;
    }

    protected function pdf_bakti_akpol($data)
    {
        // Memastikan direktori temp ada
        if (!File::exists(storage_path('temp'))) {
            File::makeDirectory(storage_path('temp'), 0755, true);
        }
        $survey = $data['survey'];
        $paths = $survey->baktiPhotos->pluck('path')->toArray();
        $send = [
            'paths' => $paths,
            'survey' => $survey
        ];
        $html = view('pdf.survey.bakti-akpol', $send)->render();

        // Simpan PDF ke sementara
        $tempPath = storage_path('temp/' . 'pdf_bakti_akpol' . '.pdf');
        // file_put_contents($tempPath, $pdf->output());
        BrowserShot::html($html)->showBackground()
            ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
            ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
            ->margins(0, 0, 0, 0)->format('A4')->savePdf($tempPath);
        return $tempPath;
    }

    protected function pdf_daftar_anak($data)
    {
        // Memastikan direktori temp ada
        if (!File::exists(storage_path('temp'))) {
            File::makeDirectory(storage_path('temp'), 0755, true);
        }

        $html = view('pdf.survey.daftar-anak', $data)->render();

        // Simpan PDF ke sementara
        $tempPath = storage_path('temp/' . 'pdf_daftar_anak' . '.pdf');
        // file_put_contents($tempPath, $pdf->output());
        BrowserShot::html($html)->showBackground()
            ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
            ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
            ->margins(0, 0, 0, 0)->format('A4')->savePdf($tempPath);
        return $tempPath;
    }

    protected function pdf_keluarga($data)
    {
        // Membuat PDF dari view
        // $pdf = Pdf::loadView('pdf.survey.keluarga-own', $data);

        // Memastikan direktori temp ada
        if (!File::exists(storage_path('temp'))) {
            File::makeDirectory(storage_path('temp'), 0755, true);
        }

        $html = view('pdf.survey.keluarga-custom', $data)->render();

        // Simpan PDF ke sementara
        $tempPath = storage_path('temp/' . 'pdf_keluarga' . '.pdf');
        // file_put_contents($tempPath, $pdf->output());
        BrowserShot::html($html)->showBackground()
            ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
            ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
            ->margins(0, 0, 0, 0)->format('A4')->savePdf($tempPath);
        return $tempPath;
    }

    protected function pdf_narasi_online($data)
    {
        // Memastikan direktori temp ada
        if (!File::exists(storage_path('temp'))) {
            File::makeDirectory(storage_path('temp'), 0755, true);
        }

        $html = view('pdf.survey.narasi_online', $data)->render();

        // Simpan PDF ke sementara
        $tempPath = storage_path('temp/' . 'pdf_narasi_online' . '.pdf');
        // file_put_contents($tempPath, $pdf->output());
        BrowserShot::html($html)->showBackground()
            ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
            ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
            ->margins(0, 0, 0, 0)->format('A4')->savePdf($tempPath);
        return $tempPath;
    }


    protected function pdf_utama($data)
    {
        // Membuat PDF dari view
        $pdf = Pdf::loadView('pdf.survey.profil', $data);

        // Memastikan direktori temp ada
        if (!File::exists(storage_path('temp'))) {
            File::makeDirectory(storage_path('temp'), 0755, true);
        }

        // Simpan PDF ke sementara
        $tempPath = storage_path('temp/' . 'pdf_utama' . '.pdf');
        file_put_contents($tempPath, $pdf->output());
        return $tempPath;
    }

    protected function pdf_profil($data)
    {
        // Memastikan direktori temp ada
        if (!File::exists(storage_path('temp'))) {
            File::makeDirectory(storage_path('temp'), 0755, true);
        }

        $html = view('pdf.survey.profil', $data)->render();

        // Simpan PDF ke sementara
        $tempPath = storage_path('temp/' . 'pdf_profil' . '.pdf');
        // file_put_contents($tempPath, $pdf->output());
        BrowserShot::html($html)->showBackground()
            ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
            ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
            ->margins(0, 0, 0, 0)->format('A4')->savePdf($tempPath);
        return $tempPath;
    }

    public function preview_formulir($id)
    {
        // Ambil data survey beserta relasinya dari database
        $survey = Survey::with(['tarunaPhotos', 'baktiPhotos', 'berkaryaPhotos'])->find($id);
        // $data = [
        //     'title' => 'Alumni',
        //     'survey' => $survey
        // ];

        $paths = $survey->baktiPhotos->pluck('path')->toArray();
        $send = [
            'paths' => $paths,
            'survey' => $survey,
        ];

        return view('pdf.survey.profil', $send);
    }


    public function print_dashboard_profile()
    {
        dd('ada');
        \pdf_dashboard_profile();
        return response()->json(['status' => 'success']);
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
