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
    private $startDate;
    private $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Survey::with(['tarunaPhotos', 'baktiPhotos', 'berkaryaPhotos', 'user']);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('timestamp', [$this->startDate->startOfDay(), $this->endDate->endOfDay()]);
        }

        return $query->latest('timestamp')->get();
    }



    public function headings(): array
    {
        return [
            'No',
            'Timestamp',
            'FOTO TARUNA',
            'NAMA',
            'PANGGILAN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'PANGKAT',
            'NRP',
            'NO TELEPON',
            'EMAIL',
            'STATUS KEDINASAN',
            'STATUS PERNIKAHAN',
            'JUMLAH ANAK',
            'ALAMAT',
            'MOTTO',
            'NARASI ONLINE',
            'FOTO KELUARGA',
            'NARASI KELUARGA',
            // Data anak pertama
            'FOTO ANAK PERTAMA',
            'NAMA ANAK PERTAMA',
            'TEMPAT LAHIR ANAK PERTAMA',
            'TANGGAL LAHIR ANAK PERTAMA',
            'JENIS KELAMIN ANAK PERTAMA',
            'PEKERJAAN ANAK PERTAMA',
            'MOTTO ANAK PERTAMA',
            // Data anak kedua
            'FOTO ANAK KEDUA',
            'NAMA ANAK KEDUA',
            'TEMPAT LAHIR ANAK KEDUA',
            'TANGGAL LAHIR ANAK KEDUA',
            'JENIS KELAMIN ANAK KEDUA',
            'PEKERJAAN ANAK KEDUA',
            'MOTTO ANAK KEDUA',
            // Data anak ketiga
            'FOTO ANAK KETIGA',
            'NAMA ANAK KETIGA',
            'TEMPAT LAHIR ANAK KETIGA',
            'TANGGAL LAHIR ANAK KETIGA',
            'JENIS KELAMIN ANAK KETIGA',
            'PEKERJAAN ANAK KETIGA',
            'MOTTO ANAK KETIGA',
            // Data anak keempat
            'FOTO ANAK KEEMPAT',
            'NAMA ANAK KEEMPAT',
            'TEMPAT LAHIR ANAK KEEMPAT',
            'TANGGAL LAHIR ANAK KEEMPAT',
            'JENIS KELAMIN ANAK KEEMPAT',
            'PEKERJAAN ANAK KEEMPAT',
            'MOTTO ANAK KEEMPAT',
            // Data anak kelima
            'FOTO ANAK KELIMA',
            'NAMA ANAK KELIMA',
            'TEMPAT LAHIR ANAK KELIMA',
            'TANGGAL LAHIR ANAK KELIMA',
            'JENIS KELAMIN ANAK KELIMA',
            'PEKERJAAN ANAK KELIMA',
            'MOTTO ANAK KELIMA',
            // Data Bakti & Karya
            'NAMA BAKTI',
            'NARASI BAKTI AKPOL',
            'NAMA KARYA PATRIATAMA 95',
            'NARASI KARYA',
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

        $jumlah_anak = '';
        $jumlah_anak = match ($data->jumlah_anak) {
            1 => 'Satu',
            2 => 'Dua',
            3 => 'Tiga',
            4 => 'Empat',
            5 => 'Lima',
            default => '-'
        };

        return [
            $this->rowNo,
            Carbon::parse($data->timestamp)->format('n/j/Y H:i:s'),
            $taruna_photo,
            $data->nama ?? '-',
            $data->panggilan ?? '-',
            $data->tempat_lahir ?? '-',
            Carbon::parse($data->tanggal_lahir)->format('n/j/Y') ?? '-',
            $data->pangkat ?? '-',
            $data->nrp ?? '-',
            $data->no_telepon ?? '-',
            $data->email ?? '-',
            $data->status_kedinasan ?? '-',
            $data->status_pernikahan ?? '-',
            $data->jumlah_anak . '/' . $jumlah_anak,
            $data->alamat ?? '-',
            $data->motto ?? '-',
            $data->narasi_personal ?? '-',
            Str::startsWith($data->foto_keluarga, 'https://drive.google.com') ?  $data->foto_keluarga : \asset($data->foto_keluarga),
            $data->narasi_keluarga ?? '-',

            // Data Anak Pertama
            Str::startsWith($data->foto_anak_pertama, 'https://drive.google.com') ?  $data->foto_anak_pertama : \asset($data->foto_anak_pertama),
            $data->nama_anak_pertama ?? '-',
            $data->tempat_lahir_anak_pertama ?? '-',
            Carbon::parse($data->tanggal_lahir_anak_pertama)->format('n/j/Y') ?? '-',
            $data->jenis_kelamin_anak_pertama ?? '-',
            $data->pekerjaan_anak_pertama ?? '-',
            $data->motto_anak_pertama ?? '-',

            // Data Anak Kedua
            Str::startsWith($data->foto_anak_kedua, 'https://drive.google.com') ?  $data->foto_anak_kedua : \asset($data->foto_anak_kedua),
            $data->nama_anak_kedua ?? '-',
            $data->tempat_lahir_anak_kedua ?? '-',
            Carbon::parse($data->tanggal_lahir_anak_kedua)->format('n/j/Y') ?? '-',
            $data->jenis_kelamin_anak_kedua ?? '-',
            $data->pekerjaan_anak_kedua ?? '-',
            $data->motto_anak_kedua ?? '-',

            // Data Anak Ketiga
            Str::startsWith($data->foto_anak_ketiga, 'https://drive.google.com') ?  $data->foto_anak_ketiga : \asset($data->foto_anak_ketiga),
            $data->nama_anak_ketiga ?? '-',
            $data->tempat_lahir_anak_ketiga ?? '-',
            Carbon::parse($data->tanggal_lahir_anak_ketiga)->format('n/j/Y') ?? '-',
            $data->jenis_kelamin_anak_ketiga ?? '-',
            $data->pekerjaan_anak_ketiga ?? '-',
            $data->motto_anak_ketiga ?? '-',

            // Data Anak Keempat
            Str::startsWith($data->foto_anak_keempat, 'https://drive.google.com') ?  $data->foto_anak_keempat : \asset($data->foto_anak_keempat),
            $data->nama_anak_keempat ?? '-',
            $data->tempat_lahir_anak_keempat ?? '-',
            Carbon::parse($data->tanggal_lahir_anak_keempat)->format('n/j/Y') ?? '-',
            $data->jenis_kelamin_anak_keempat ?? '-',
            $data->pekerjaan_anak_keempat ?? '-',
            $data->motto_anak_keempat ?? '-',

            // Data Anak Kelima
            Str::startsWith($data->foto_anak_kelima, 'https://drive.google.com') ?  $data->foto_anak_kelima : \asset($data->foto_anak_kelima),
            $data->nama_anak_kelima ?? '-',
            $data->tempat_lahir_anak_kelima ?? '-',
            Carbon::parse($data->tanggal_lahir_anak_kelima)->format('n/j/Y') ?? '-',
            $data->jenis_kelamin_anak_kelima ?? '-',
            $data->pekerjaan_anak_kelima ?? '-',
            $data->motto_anak_kelima ?? '-',

            // Bakti & Karya
            $data->nama_bakti ?? '-',
            $data->narasi_bakti ?? '-',
            $data->nama_karya ?? '-',
            $data->narasi_karya ?? '-',
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
        $sheet->getStyle('A1:BF1')->applyFromArray($headerStyleArray);

        // Center alignment untuk kolom NRP dan No
        $centerAlignmentStyleArray = [
            'alignment' => [                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ]
        ];
        $sheet->getStyle('A:A')->applyFromArray($centerAlignmentStyleArray);  // Kolom No
        $sheet->getStyle('D:D')->applyFromArray($centerAlignmentStyleArray);  // Kolom Panggilan
        $sheet->getStyle('C:C')->applyFromArray($centerAlignmentStyleArray);  // Kolom Taruna Foto
        $sheet->getStyle('E:E')->applyFromArray($centerAlignmentStyleArray);  // Kolom TEMPAT LAHIR
        $sheet->getStyle('F:F')->applyFromArray($centerAlignmentStyleArray);  // Kolom TGL LAHIR
        $sheet->getStyle('G:G')->applyFromArray($centerAlignmentStyleArray);  // Kolom Pangkat
        $sheet->getStyle('H:H')->applyFromArray($centerAlignmentStyleArray);  // Kolom NRP
        $sheet->getStyle('J:J')->applyFromArray($centerAlignmentStyleArray);  // Kolom NO TELEPON
        $sheet->getStyle('K:K')->applyFromArray($centerAlignmentStyleArray);  // Kolom EMAIL
        $sheet->getStyle('L:L')->applyFromArray($centerAlignmentStyleArray);  // Kolom DINAS
        $sheet->getStyle('M:M')->applyFromArray($centerAlignmentStyleArray);  // Kolom PERNIKAHAN

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
        $sheet->getStyle('A1:BF' . $lastRow)->applyFromArray($allDataBordersStyleArray);
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
