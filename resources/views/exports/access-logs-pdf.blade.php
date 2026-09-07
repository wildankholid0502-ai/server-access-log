<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Akses Ruang Server</title>

    <style>
        /* =========================================================
           PENGATURAN HALAMAN
           ========================================================= */
        @page {
            size: A4 portrait;
            margin: 2.2cm 1.5cm 2.4cm 1.5cm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: #000;
            line-height: 1.2;
            margin: 0;
            padding: 0;
        }

        /* =========================================================
           HEADER
           ========================================================= */
        .header {
            width: 100%;
            margin-top: -1.7cm;
            margin-bottom: 8px;
        }

        .top-green {
            width: 58%;
            height: 0.35cm;
            background-color: #00843D;
            margin: 0 auto 8px auto;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
        }

        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .logo-left {
            width: 32%;
            text-align: left;
        }

        .logo-center {
            width: 36%;
            text-align: center;
        }

        .logo-right {
            width: 32%;
            text-align: right;
        }

        .img-picture1 {
            height: 0.75cm;
            width: auto;
            display: inline-block;
        }

        .img-center {
            height: 1.0cm;
            width: auto;
            display: inline-block;
        }

        .img-picture3 {
            height: 1.0cm;
            width: auto;
            display: inline-block;
        }

        /* =========================================================
           JUDUL
           ========================================================= */
        .title {
            text-align: center;
            font-size: 14pt;
            font-weight: normal;
            margin-top: 8px;
            margin-bottom: 12px;
        }

        /* =========================================================
           TABEL UTAMA
           ========================================================= */
        .content-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 20px;
        }

        .content-table th,
        .content-table td {
            border: 1px solid #000;
            padding: 5px 6px;
            font-size: 9pt;
            vertical-align: top;
            word-wrap: break-word;
        }

        .content-table th {
            text-align: center;
            font-weight: bold;
            background-color: #fff;
        }

        .text-center {
            text-align: center;
        }

        .ticket-number {
            text-align: center;
            font-weight: normal;
        }

        .visitor-name {
            font-weight: bold;
        }

        .time {
            color: #087F4E;
            font-weight: bold;
        }

        .category {
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* =========================================================
           DETAIL RUANGAN & RAK
           ========================================================= */
        .room-box {
            border: 1px solid #d5d5d5;
            padding: 5px;
            margin-top: 4px;
            margin-bottom: 5px;
        }

        .room-title {
            font-weight: bold;
            font-size: 8.5pt;
            padding-bottom: 4px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 4px;
        }

        .room-table {
            width: 100%;
            border-collapse: collapse;
        }

        .room-table td {
            border: none !important;
            padding: 2px 3px !important;
            font-size: 8pt !important;
            vertical-align: top;
        }

        .inspection {
            font-size: 8.5pt;
            margin-top: 4px;
            line-height: 1.25;
        }

        /* =========================================================
           TANDA TANGAN
           ========================================================= */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            page-break-inside: avoid;
        }

        .signature-table td {
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            padding: 0;
            border: none;
            font-size: 10pt;
        }

        .sign-space {
            height: 75px;
        }

        tr {
            page-break-inside: avoid;
        }

        thead {
            display: table-header-group;
        }
    </style>
</head>

<body>

    <!-- =========================================================
         HEADER
         ========================================================= -->
    <div class="header">
        <div class="top-green"></div>

        <table class="header-table">
            <tr>
                <td class="logo-left">
                    <img src="{{ public_path('Images/Picture1.png') }}" class="img-picture1" alt="Danantara Indonesia">
                </td>
                <td class="logo-center">
                    <img src="{{ public_path('Images/Picture2.png') }}" class="img-center" alt="Pupuk Indonesia">
                </td>
                <td class="logo-right">
                    <img src="{{ public_path('Images/Picture3.png') }}" class="img-picture3" alt="Pupuk Kujang">
                </td>
            </tr>
        </table>
    </div>

    <!-- =========================================================
         JUDUL
         ========================================================= -->
    <div class="title">
        Log Akses Ruang Server
    </div>

    <!-- =========================================================
         TABEL DATA LOG AKSES
         ========================================================= -->
    <table class="content-table">
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 12%;">Waktu</th>
                <th style="width: 11%;">No. Tiket</th>
                <th style="width: 16%;">Identitas Akses</th>
                <th style="width: 12%;">Departemen</th>
                <th style="width: 14%;">Pendamping</th>
                <th style="width: 30%;">Tujuan / Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $index => $log)
                @php
                    $tanggalWaktu = \Carbon\Carbon::parse($log->logged_at ?? $log->created_at);
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">
                        <div>{{ $tanggalWaktu->format('d/m/Y') }}</div>
                        <div class="time">{{ $tanggalWaktu->format('H:i:s') }}</div>
                    </td>
                    <td class="ticket-number">
                        @if(isset($log->ticket_number) && $log->ticket_number)
                            #{{ $log->ticket_number }}
                        @elseif(isset($log->identity_number) && $log->identity_number)
                            #{{ $log->identity_number }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <div class="visitor-name">{{ $log->visitor_name }}</div>
                    </td>
                    <td>{{ $log->department ?? '-' }}</td>
                    <td>{{ $log->escort_name ?? '-' }}</td>
                    <td>
                        <div class="category">{{ $log->category ?? '-' }}</div>

                        @if($log->category === 'Maintenance Rutin')
                            <div class="room-box">
                                <div class="room-title">
                                    Ruang:
                                    {{ $log->temp_room ?? $log->temperature ?? '-' }}°C
                                    &nbsp; | &nbsp;
                                    {{ $log->hum_room ?? $log->humidity ?? '-' }}%
                                </div>

                                <table class="room-table">
                                    <tr>
                                        <td><strong>R1:</strong> {{ $log->temp_rack_1 ?? '-' }}°C / {{ $log->hum_rack_1 ?? '-' }}%</td>
                                        <td><strong>R2:</strong> {{ $log->temp_rack_2 ?? '-' }}°C / {{ $log->hum_rack_2 ?? '-' }}%</td>
                                    </tr>
                                    <tr>
                                        <td><strong>R3:</strong> {{ $log->temp_rack_3 ?? '-' }}°C / {{ $log->hum_rack_3 ?? '-' }}%</td>
                                        <td><strong>R4:</strong> {{ $log->temp_rack_4 ?? '-' }}°C / {{ $log->hum_rack_4 ?? '-' }}%</td>
                                    </tr>
                                    <tr>
                                        <td><strong>R5:</strong> {{ $log->temp_rack_5 ?? '-' }}°C / {{ $log->hum_rack_5 ?? '-' }}%</td>
                                        <td><strong>R6:</strong> {{ $log->temp_rack_6 ?? '-' }}°C / {{ $log->hum_rack_6 ?? '-' }}%</td>
                                    </tr>
                                </table>
                            </div>

                            @if($log->visual_check)
                                <div class="inspection">
                                    <strong>Visual:</strong> "{{ $log->visual_check }}"
                                </div>
                            @endif

                            @if($log->notes)
                                <div class="inspection">
                                    <strong>Ket:</strong> "{{ $log->notes }}"
                                </div>
                            @endif
                        @else
                            @if($log->notes)
                                <div class="inspection">{{ $log->notes }}</div>
                            @else
                                <span style="color: #888;">-</span>
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 15px;">
                        Tidak ada data log akses yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- =========================================================
         TANDA TANGAN
         ========================================================= -->
    <table class="signature-table">
        <tr>
            <td>Di buat oleh</td>
            <td>Mengetahui</td>
            <td>Disetujui</td>
        </tr>
        <tr>
            <td class="sign-space"></td>
            <td class="sign-space"></td>
            <td class="sign-space"></td>
        </tr>
        <tr>
            <td><strong>System Administrator</strong></td>
            <td><strong>Avp Infrastruktur</strong></td>
            <td><strong>VP Teknologi Informasi</strong></td>
        </tr>
    </table>

    <!-- =========================================================
         FOOTER CANVAS SCRIPT (VERSI PITA TIPIS & RAMPING)
         ========================================================= -->
    <script type="text/php">
        if (isset($pdf)) {
            $textComp = "PT Pupuk Kujang";
            $textAddr = "Jl. Jend A. Yani No 39 Cikampek 41373 Karawang, Jawa Barat, Telp : (0264) 316141, 317007 (Hunting System)";

            $fBold = $fontMetrics->get_font("helvetica", "bold");
            $fNorm = $fontMetrics->get_font("helvetica", "normal");

            $w = $pdf->get_width();
            $h = $pdf->get_height();

            $wComp = $fontMetrics->get_text_width($textComp, $fBold, 9);
            $wAddr = $fontMetrics->get_text_width($textAddr, $fNorm, 7.5);

            $xComp = ($w - $wComp) / 2;
            $xAddr = ($w - $wAddr) / 2;

            // 1. Teks Perusahaan & Alamat
            $pdf->text($xComp, $h - 38, $textComp, $fBold, 9, array(0.33, 0.33, 0.33));
            $pdf->text($xAddr, $h - 26, $textAddr, $fNorm, 7.5, array(0.4, 0.4, 0.4));

            // 2. Garis Kuning Emas (Tebal 2.5px)
            $pdf->filled_rectangle(0, $h - 13.5, $w, 2.5, array(0.965, 0.769, 0.0));

            // 3. Pita Hijau Ramping (Tebal 11px menempel ke dasar kertas)
            $bars = 12;
            $barWidth = $w / $bars;
            $cLight = array(0.0, 0.518, 0.239); // #00843D
            $cDark  = array(0.043, 0.400, 0.188); // #0b6630

            for ($i = 0; $i < $bars; $i++) {
                $col = ($i % 2 === 0) ? $cLight : $cDark;
                $pdf->filled_rectangle($i * $barWidth, $h - 11, $barWidth + 1, 11, $col);
            }
        }
    </script>

</body>
</html>