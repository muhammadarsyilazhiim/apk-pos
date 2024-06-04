<?php

namespace App\Exports;

use App\Supply;
use Auth;
use App\Acces;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

class ExportExcelPasok implements WithMultipleSheets, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        $supplySheet = new SupplySheet();
        $sheets[] = $supplySheet;

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

class SupplySheet implements FromView, WithTitle
{
    public function title(): string
    {
        return 'Supply';
    }

    public function view(): View
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)->first();
        if ($check_access->kelola_laporan == 1) {
            $jenis_laporan = request()->input('jns_laporan');
            $current_time = Carbon::now()->isoFormat('Y-MM-DD');
            if ($jenis_laporan == 'period') {
                $period = request()->input('period');
                $time = request()->input('time');
                if ($period == 'minggu') {
                    $last_time = Carbon::now()->subWeeks($time)->isoFormat('Y-MM-DD');
                    $tgl_awal = $last_time;
                    $tgl_akhir = $current_time;
                } elseif ($period == 'bulan') {
                    $last_time = Carbon::now()->subMonths($time)->isoFormat('Y-MM-DD');
                    $tgl_awal = $last_time;
                    $tgl_akhir = $current_time;
                } elseif ($period == 'tahun') {
                    $last_time = Carbon::now()->subYears($time)->isoFormat('Y-MM-DD');
                    $tgl_awal = $last_time;
                    $tgl_akhir = $current_time;
                }

                $supplies = Supply::select('kode_barang', 'nama_barang', 'merek', 'jumlah', 'harga_beli', 'pemasok')
                    ->whereBetween('created_at', [$last_time, $current_time])
                    // ->distinct('kode_transaksi')
                    ->get();
            } else {
                $start_date = request()->input('tgl_awal_export');
                $end_date = request()->input('tgl_akhir_export');
                $start_date2 = Carbon::createFromFormat('d-m-Y', $start_date)->startOfDay();
                $end_date2 = Carbon::createFromFormat('d-m-Y', $end_date)->endOfDay();

                $supplies = Supply::select('kode_barang', 'nama_barang', 'merek', 'jumlah', 'harga_beli', 'pemasok')
                    ->whereBetween('created_at', [$start_date2, $end_date2])
                    // ->distinct('kode_transaksi')
                    ->get();

                $tgl_awal = $start_date2->toDateString();
                $tgl_akhir = $end_date2->toDateString();
            }

            return view('export.supplies', compact('supplies', 'tgl_awal', 'tgl_akhir'));
        } else {
            return back();
        }
    }
}
