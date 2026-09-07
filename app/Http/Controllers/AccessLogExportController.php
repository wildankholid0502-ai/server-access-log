<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AccessLogExportController extends Controller
{
    public function export(Request $request): StreamedResponse
    {
        $category = $request->input('category');
        $fileSuffix = $category ? strtolower(str_replace(' ', '-', $category)) : 'semua-kategori';
        $fileName = 'log-akses-ruang-server-' . $fileSuffix . '-' . date('Y-m-d_H-i-s') . '.csv';

        return response()->streamDownload(function () use ($request, $category) {
            $handle = fopen('php://output', 'w');

            // 1. Tambahkan UTF-8 BOM agar simbol derajat dan teks terbaca rapi di Microsoft Excel
            fputs($handle, "\xEF\xBB\xBF");

            // Delimiter titik koma (;) standar format Regional Indonesia
            $delimiter = ';';

            // 2. Tentukan Header Kolom CSV Sesuai Kategori
            if ($category === 'Maintenance Rutin') {
                $headers = [
                    'No',
                    'Waktu Masuk (WIB)',
                    'No. Tiket',
                    'Nama Pengunjung',
                    'Departemen / Vendor',
                    'Pendamping Internal',
                    'Tujuan Akses',
                    'Suhu Ruangan (°C)',
                    'Kelembaban Ruangan (%)',
                    'Suhu R1 (°C)', 'Kelembaban R1 (%)',
                    'Suhu R2 (°C)', 'Kelembaban R2 (%)',
                    'Suhu R3 (°C)', 'Kelembaban R3 (%)',
                    'Suhu R4 (°C)', 'Kelembaban R4 (%)',
                    'Suhu R5 (°C)', 'Kelembaban R5 (%)',
                    'Suhu R6 (°C)', 'Kelembaban R6 (%)',
                    'Pengecekan Visual',
                    'Catatan',
                ];
            } elseif ($category === 'Kunjungan' || $category === 'Insidental') {
                $headers = [
                    'No',
                    'Waktu Masuk (WIB)',
                    'No. Tiket',
                    'Nama Pengunjung',
                    'Departemen / Vendor',
                    'Pendamping Internal',
                    'Tujuan Akses',
                    'Catatan',
                ];
            } else {
                // Semua Kategori
                $headers = [
                    'No',
                    'Waktu Masuk (WIB)',
                    'No. Tiket',
                    'Nama Pengunjung',
                    'Departemen / Vendor',
                    'Pendamping Internal',
                    'Tujuan Akses',
                    'Catatan',
                    'Suhu Ruangan (°C)',
                    'Kelembaban Ruangan (%)',
                    'Suhu R1 (°C)', 'Kelembaban R1 (%)',
                    'Suhu R2 (°C)', 'Kelembaban R2 (%)',
                    'Suhu R3 (°C)', 'Kelembaban R3 (%)',
                    'Suhu R4 (°C)', 'Kelembaban R4 (%)',
                    'Suhu R5 (°C)', 'Kelembaban R5 (%)',
                    'Suhu R6 (°C)', 'Kelembaban R6 (%)',
                    'Pengecekan Visual',
                ];
            }

            fputcsv($handle, $headers, $delimiter);

            // 3. Filter Query Database
            $query = AccessLog::query();

            if (!empty($category)) {
                $query->where('category', $category);
            }

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('ticket_number', 'like', "%{$search}%")
                      ->orWhere('visitor_name', 'like', "%{$search}%")
                      ->orWhere('department', 'like', "%{$search}%")
                      ->orWhere('escort_name', 'like', "%{$search}%")
                      ->orWhere('notes', 'like', "%{$search}%");
                });
            }

            if ($request->filled('start_date')) {
                $query->whereDate('logged_at', '>=', $request->start_date);
            }
            if ($request->filled('end_date')) {
                $query->whereDate('logged_at', '<=', $request->end_date);
            }

            // 4. Baris Data CSV Dinamis
            $no = 1;
            $query->latest('logged_at')->chunk(100, function ($logs) use ($handle, $delimiter, $category, &$no) {
                foreach ($logs as $log) {
                    $waktuMasuk = \Carbon\Carbon::parse($log->logged_at ?? $log->created_at)->format('d/m/Y H:i:s');
                    $tiket = $log->ticket_number ?? '-';

                    if ($category === 'Maintenance Rutin') {
                        $row = [
                            $no++,
                            $waktuMasuk,
                            $tiket,
                            $log->visitor_name,
                            $log->department,
                            $log->escort_name,
                            $log->category,
                            $log->temp_room ?? '-',
                            $log->hum_room ?? '-',
                            $log->temp_rack_1 ?? '-', $log->hum_rack_1 ?? '-',
                            $log->temp_rack_2 ?? '-', $log->hum_rack_2 ?? '-',
                            $log->temp_rack_3 ?? '-', $log->hum_rack_3 ?? '-',
                            $log->temp_rack_4 ?? '-', $log->hum_rack_4 ?? '-',
                            $log->temp_rack_5 ?? '-', $log->hum_rack_5 ?? '-',
                            $log->temp_rack_6 ?? '-', $log->hum_rack_6 ?? '-',
                            $log->visual_check ?? '-',
                            $log->notes ?? '-',
                        ];
                    } elseif ($category === 'Kunjungan' || $category === 'Insidental') {
                        $row = [
                            $no++,
                            $waktuMasuk,
                            $tiket,
                            $log->visitor_name,
                            $log->department,
                            $log->escort_name,
                            $log->category,
                            $log->notes ?? '-',
                        ];
                    } else {
                        $row = [
                            $no++,
                            $waktuMasuk,
                            $tiket,
                            $log->visitor_name,
                            $log->department,
                            $log->escort_name,
                            $log->category,
                            $log->notes ?? '-',
                            $log->temp_room ?? '-',
                            $log->hum_room ?? '-',
                            $log->temp_rack_1 ?? '-', $log->hum_rack_1 ?? '-',
                            $log->temp_rack_2 ?? '-', $log->hum_rack_2 ?? '-',
                            $log->temp_rack_3 ?? '-', $log->hum_rack_3 ?? '-',
                            $log->temp_rack_4 ?? '-', $log->hum_rack_4 ?? '-',
                            $log->temp_rack_5 ?? '-', $log->hum_rack_5 ?? '-',
                            $log->temp_rack_6 ?? '-', $log->hum_rack_6 ?? '-',
                            $log->visual_check ?? '-',
                        ];
                    }

                    fputcsv($handle, $row, $delimiter);
                }
            });

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }

    public function exportPdf(Request $request)
    {
        $category = $request->input('category');
        $query = AccessLog::query();

        // 1. Filter Kategori
        if (!empty($category)) {
            $query->where('category', $category);
        }

        // 2. Filter Pencarian Teks
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('visitor_name', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('escort_name', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        // 3. Filter Rentang Tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('logged_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('logged_at', '<=', $request->end_date);
        }

        $logs = $query->latest('logged_at')->get();

        $data = [
            'logs'      => $logs,
            'category'  => $category,
            'startDate' => $request->start_date,
            'endDate'   => $request->end_date,
            'printedAt' => now()->translatedFormat('d F Y, H:i:s') . ' WIB',
        ];

        // Konfigurasi Dompdf: Mengaktifkan PHP canvas script dan path asset lokal
        $pdf = Pdf::loadView('exports.access-logs-pdf', $data)
            ->setPaper('a4', 'portrait')
            ->setOption('isPhpEnabled', true)
            ->setOption('isRemoteEnabled', true);

        $fileSuffix = $category ? strtolower(str_replace(' ', '-', $category)) : 'semua-kategori';
        $fileName = 'Laporan-Log-Akses-Ruang-Server-' . $fileSuffix . '-' . date('Ymd-His') . '.pdf';

        return $pdf->download($fileName);
    }
}