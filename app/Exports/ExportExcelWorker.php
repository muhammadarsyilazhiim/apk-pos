<?php

namespace App\Exports;

use App\Activity;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportExcelWorker implements WithMultipleSheets, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        $workerSheet = new WorkerSheet();
        $sheets[] = $workerSheet;

        return $sheets;
    }

    public function styles(Worksheet $sheet)
    {
        // Set border and fill for the table
        $tableRange = 'A1:E' . $sheet->getHighestRow();
        $sheet->getStyle($tableRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00'],
            ],
        ]);

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);

        // Set heading styles
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'FF0000', // Ganti dengan kode warna yang diinginkan, misalnya 'FF0000' untuk merah
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
    }

}

class WorkerSheet implements FromView, WithTitle
{
    public function title(): string
    {
        return 'Activity';
    }

    public function view(): View
    {
        $activities = Activity::select('user', 'nama_kegiatan', 'jumlah')->get();
        return view('export.activities', compact('activities'));
    }
}
