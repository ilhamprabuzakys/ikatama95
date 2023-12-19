<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Survey;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FormulirExportImage implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithDrawings
{
    private $rowNo = 0;
    /**
     * @return \Illuminate\Support\Collection
     */
    private $dataCollection;

    public function collection()
    {
        if (!$this->dataCollection) {
            $this->dataCollection = Survey::with(['tarunaPhotos', 'baktiPhotos', 'berkaryaPhotos', 'user'])->latest('created_at')->get();
        }
        return $this->dataCollection;
    }

    public function headings(): array
    {
        return [
            'No',
            'Timestamp',
            'FOTO TERKINI',
            'NAMA',
            'PANGGILAN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'PANGKAT',
            'NRP',
            'FOTO TARUNA',
            'NO TELEPON',
            'EMAIL',
        ];
    }

    public function map($data): array
    {
        $this->rowNo++; // Increment counter setiap kali fungsi map dipanggil
        if (Str::startsWith($data->foto_taruna, 'https://drive.google.com')) {
            $taruna_photo = $data->foto_taruna;
        } else {
            $taruna_photo = \asset($data->foto_taruna);
        }

        $foto_terkini = '-';
        if (Str::startsWith($data->foto_terkini, 'https://drive.google.com')) {
            $foto_terkini = '-';
        } else {
            $foto_terkini = \asset($data->foto_terkini);
        }
        return [
            $this->rowNo,
            Carbon::parse($data->timestamp)->format('n/j/Y H:i:s'),
            "", // Placeholder untuk gambar
            $data->nama ?? '-',
            $data->panggilan ?? '-',
            $data->tempat_lahir,
            Carbon::parse($data->tanggal_lahir)->format('n/j/Y'),
            $data->pangkat,
            $data->nrp,
            $taruna_photo,
            $data->no_telepon,
            $data->email ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header style
        $headerStyleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ]
        ];
        $sheet->getStyle('A1:K1')->applyFromArray($headerStyleArray);

        // Center alignment untuk kolom NRP dan No
        $centerAlignmentStyleArray = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ]
        ];
        $sheet->getStyle('A:A')->applyFromArray($centerAlignmentStyleArray);  // Kolom No
        $sheet->getStyle('D:D')->applyFromArray($centerAlignmentStyleArray);  // Kolom Panggilan
        $sheet->getStyle('E:E')->applyFromArray($centerAlignmentStyleArray);  // Kolom TEMPAT LAHIR
        $sheet->getStyle('F:F')->applyFromArray($centerAlignmentStyleArray);  // Kolom TGL LAHIR
        $sheet->getStyle('G:G')->applyFromArray($centerAlignmentStyleArray);  // Kolom Pangkat
        $sheet->getStyle('H:H')->applyFromArray($centerAlignmentStyleArray);  // Kolom NRP
        $sheet->getStyle('J:J')->applyFromArray($centerAlignmentStyleArray);  // Kolom NO TELEPON
        $sheet->getStyle('K:K')->applyFromArray($centerAlignmentStyleArray);  // Kolom EMAIL

        // Memberikan semua data batas (all border)
        $allDataBordersStyleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ]
        ];
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:K' . $lastRow)->applyFromArray($allDataBordersStyleArray);

        $surveys = $this->collection();
        foreach ($surveys as $index => $survey) {
            if (!Str::startsWith($survey->foto_terkini, 'https://drive.google.com')) {
                $height = 90;  // tinggi gambar
                $rowNum = $index + 2;  // +2 karena mulai dari baris 2 (header di baris pertama)
                $sheet->getRowDimension($rowNum)->setRowHeight($height);
            }
        }

        $fixedWidth = 35;  // contoh lebar yang diinginkan
        $sheet->getColumnDimension('C')->setWidth($fixedWidth);
    }

    // Di fungsi drawings()
    public function drawings()
    {
        $drawings = [];
        $surveys = $this->collection();

        foreach ($surveys as $index => $survey) {
            if (!Str::startsWith($survey->foto_terkini, 'https://drive.google.com')) {
                $drawing = new Drawing();
                $drawing->setName('Foto Terkini ' . $index);
                $drawing->setDescription('Foto Terkini');
                // Mengubah URL menjadi path fisik
                $relativePath = Str::replaceFirst('storage/', '', $survey->foto_terkini);
                $drawing->setPath(storage_path('app/public/' . $relativePath));
                $drawing->setHeight(90);
                $drawing->setCoordinates('C' . ($index + 2));

                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }


    /* public function columnWidths(): array
    {
        return [
            'A' => 5,  // Anggap saja lebar kolom No adalah 5
            'B' => 20, // Angka-angka ini hanya contoh, Anda bisa menyesuaikannya
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
        ];
    } */
}
