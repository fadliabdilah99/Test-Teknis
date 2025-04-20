<?php

namespace App\Exports;

use App\Models\pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class pegawaisExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return pegawai::with(['jabatan', 'golongan', 'eselon', 'agama', 'unitKerja'])->get();
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1f355e'],
                ],
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            "Tempat\nLahir",
            'Alamat',
            'Tgl Lahir',
            'L/P',
            'Gol',
            'Eselon',
            'Jabatan',
            "Tempat\nTugas",
            'Agama',
            "Unit\nKerja",
            'No. HP',
            'NPWP',
        ];
    }

   

    public function map($pegawai): array
    {
        return [
            $pegawai->nip,
            $pegawai->nama,
            $pegawai->tempat_lahir ?? '-',
            $pegawai->alamat ?? '-',
            $pegawai->tgl_lahir ?? '-',
            $pegawai->jenis_kelamin ?? '-',
            $pegawai->golongan->gol ?? '-',
            $pegawai->eselon->eselon ?? '-',
            $pegawai->jabatan->jabatan ?? '-',
            $pegawai->tempat_tugas ?? '-',
            $pegawai->agama->agama ?? '-',
            $pegawai->unitKerja->nama ?? '-',
            $pegawai->no_hp ?? '-',
            $pegawai->npwp ?? '-',
        ];
    }
}
