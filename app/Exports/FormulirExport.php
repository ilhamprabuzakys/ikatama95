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
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FormulirExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    private $rowNo = 0;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Survey::with(['tarunaPhotos', 'baktiPhotos', 'berkaryaPhotos', 'user'])->latest('created_at')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Timestamp',
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
        return [
            $this->rowNo, // Tambahkan nomor baris
            Carbon::parse($data->timestamp)->format('n/j/Y H:i:s'),
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
