<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class PDFViewController extends Controller
{
    public function keluarga($id)
    {
        // Ambil data survey beserta relasinya dari database
        $survey = Survey::with(['tarunaPhotos', 'baktiPhotos', 'berkaryaPhotos'])->find($id);
        $data = [
            'title' => 'Alumni',
            'survey' => $survey
        ];

        return view('pdf.survey.keluarga-own', $data);
    }
}
