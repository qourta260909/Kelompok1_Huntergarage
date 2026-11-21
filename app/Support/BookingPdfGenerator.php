<?php

namespace App\Support;

class BookingPdfGenerator
{
    /**
     * Generate a clean A4 vector PDF (PDF 1.4) for Hunter Garage Booking Receipt.
     *
     * @param  array<string, string>  $data
     */
    public static function generate(array $data): string
    {
        $kodeBooking = self::clean($data['kode_booking'] ?? 'BKG-0001');
        $statusText = self::clean($data['status_text'] ?? 'Menunggu Konfirmasi');
        $kendaraan = self::clean($data['kendaraan'] ?? '-');
        $tahun = self::clean($data['tahun'] ?? '-');
        $platNomor = self::clean($data['plat_nomor'] ?? '-');
        $layanan = self::clean($data['layanan'] ?? '-');
        $tanggal = self::clean($data['tanggal'] ?? '-');
        $waktu = self::clean($data['waktu'] ?? '-');
        $nama = self::clean($data['nama'] ?? '-');
        $telepon = self::clean($data['telepon'] ?? '-');
        $metodePembayaran = self::clean($data['metode_pembayaran'] ?? 'Qris');
        $total = self::clean($data['total'] ?? 'Rp0');
        $dicetakPada = self::clean($data['dicetak_pada'] ?? date('d/m/Y H:i'));

        $s = [];

        // 1. Header Banner (Dark Box)
        $s[] = '0.09 0.09 0.11 rg';
        $s[] = '45 735 505 68 re f';

        // Brand title & subtitle in white / amber
        $s[] = '1 1 1 rg';
        $s[] = self::text(65, 774, 'F2', 18, 'HUNTER GARAGE');
        $s[] = '0.98 0.80 0.08 rg';
        $s[] = self::text(65, 758, 'F2', 9, 'SERVIS DAN SUKU CADANG RESMI');
        $s[] = '0.83 0.83 0.85 rg';
        $s[] = self::text(65, 745, 'F1', 8.5, 'Jl. Taruna Praja Banjarbaru, Kalimantan Selatan | Jam Operasional: 08.00 - 22.00 WITA');

        // Right header label
        $s[] = '1 1 1 rg';
        $s[] = self::text(405, 772, 'F2', 12, 'BUKTI BOOKING');
        $s[] = '0.83 0.83 0.85 rg';
        $s[] = self::text(405, 756, 'F1', 8.5, 'Dicetak: ' . $dicetakPada);

        // 2. Booking Code Summary Box
        $s[] = '0.90 0.90 0.91 rg';
        $s[] = '45 668 505 54 re f';
        $s[] = '0.45 0.45 0.48 RG 1 w';
        $s[] = '45 668 505 54 re S';

        $s[] = '0.06 0.06 0.07 rg';
        $s[] = self::text(65, 699, 'F2', 14, 'Booking Berhasil Dikirim');
        $s[] = '0.25 0.25 0.28 rg';
        $s[] = self::text(65, 682, 'F1', 9.5, 'Jadwal servis sudah terdaftar. Simpan bukti booking ini saat kunjungan.');

        // White code badge on the right
        $s[] = '1 1 1 rg';
        $s[] = '410 678 125 34 re f';
        $s[] = '0.15 0.15 0.17 RG 1.2 w';
        $s[] = '410 678 125 34 re S';
        $s[] = '0.06 0.06 0.07 rg';
        $s[] = self::text(432, 690, 'F2', 15, $kodeBooking);

        // 3. Detail Booking Table Card
        $tableTop = 648;
        $rowHeight = 28;
        $rows = [
            ['Id booking', $kodeBooking],
            ['Status Booking', $statusText],
            ['Kendaraan', $kendaraan],
            ['Tahun', $tahun],
            ['Plat Nomor', $platNomor],
            ['Layanan', $layanan],
            ['Tanggal', $tanggal],
            ['Waktu', $waktu],
            ['Nama', $nama],
            ['Nomor WhatsApp', $telepon],
            ['Metode Pembayaran', $metodePembayaran],
        ];

        $tableHeight = 36 + (count($rows) * $rowHeight);
        $tableBottom = $tableTop - $tableHeight;

        // Table Header Bar
        $s[] = '0.96 0.96 0.97 rg';
        $s[] = sprintf('45 %d 505 36 re f', $tableTop - 36);
        $s[] = '0.06 0.06 0.07 rg';
        $s[] = self::text(65, $tableTop - 23, 'F2', 13, 'Detail Booking');

        // Status text on header right
        $s[] = '0.25 0.25 0.28 rg';
        $s[] = self::text(390, $tableTop - 22, 'F2', 9.5, 'Status: ' . $statusText);

        // Outer border of Detail Booking table
        $s[] = '0.63 0.63 0.67 RG 1 w';
        $s[] = sprintf('45 %d 505 %d re S', $tableBottom, $tableHeight);

        // Line under table header
        $yCursor = $tableTop - 36;
        $s[] = '0.45 0.45 0.48 RG 0.8 w';
        $s[] = sprintf('45 %d m 550 %d l S', $yCursor, $yCursor);

        foreach ($rows as $index => [$label, $val]) {
            $rowBottom = $yCursor - $rowHeight;
            $textY = $rowBottom + 9;

            $s[] = '0.32 0.32 0.36 rg';
            $s[] = self::text(65, $textY, 'F1', 10.5, $label);

            $s[] = '0.06 0.06 0.07 rg';
            $s[] = self::text(230, $textY, 'F2', 10.5, $val);

            if ($index < count($rows) - 1) {
                $s[] = '0.75 0.75 0.78 RG 0.6 w';
                $s[] = sprintf('45 %d m 550 %d l S', $rowBottom, $rowBottom);
            }

            $yCursor = $rowBottom;
        }

        // 4. Total Bar
        $totalBoxY = $tableBottom - 48;
        $s[] = '0.89 0.89 0.91 rg';
        $s[] = sprintf('45 %d 505 36 re f', $totalBoxY);
        $s[] = '0.63 0.63 0.67 RG 1 w';
        $s[] = sprintf('45 %d 505 36 re S', $totalBoxY);

        $s[] = '0.06 0.06 0.07 rg';
        $s[] = self::text(65, $totalBoxY + 12, 'F2', 14, 'Total');
        $s[] = self::text(230, $totalBoxY + 12, 'F2', 14, $total);

        // 5. Langkah Selanjutnya Box
        $stepsBoxY = $totalBoxY - 120;
        $s[] = '0.97 0.97 0.98 rg';
        $s[] = sprintf('45 %d 505 102 re f', $stepsBoxY);
        $s[] = '0.83 0.83 0.85 RG 0.8 w';
        $s[] = sprintf('45 %d 505 102 re S', $stepsBoxY);

        $s[] = '0.06 0.06 0.07 rg';
        $s[] = self::text(65, $stepsBoxY + 80, 'F2', 11.5, 'Langkah Selanjutnya:');
        $s[] = '0.25 0.25 0.28 rg';
        $s[] = self::text(65, $stepsBoxY + 60, 'F1', 9.5, '1. Admin akan mengkonfirmasikan jadwal servis Anda melalui WhatsApp.');
        $s[] = self::text(65, $stepsBoxY + 42, 'F1', 9.5, '2. Datang ke bengkel Hunter Garage sesuai tanggal dan jam yang disetujui.');
        $s[] = self::text(65, $stepsBoxY + 24, 'F1', 9.5, '3. Tunjukkan kode booking (' . $kodeBooking . ') ini kepada petugas saat kedatangan.');

        $stream = implode("\n", $s);

        return self::assemblePdf($stream);
    }

    private static function text(float $x, float $y, string $font, float $size, string $text): string
    {
        $escaped = strtr($text, [
            '\\' => '\\\\',
            '(' => '\(',
            ')' => '\)',
        ]);

        return sprintf('BT /%s %.1f Tf %.1f %.1f Td (%s) Tj ET', $font, $size, $x, $y, $escaped);
    }

    private static function clean(string $value): string
    {
        $cleaned = preg_replace('/[^\x20-\x7E]/', '', $value);

        return trim((string) $cleaned) !== '' ? trim((string) $cleaned) : '-';
    }

    private static function assemblePdf(string $contentStream): string
    {
        $objects = [];
        $objects[1] = '<< /Type /Catalog /Pages 2 0 R >>';
        $objects[2] = '<< /Type /Pages /Kids [3 0 R] /Count 1 >>';
        $objects[3] = '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 4 0 R /F2 5 0 R >> >> /Contents 6 0 R >>';
        $objects[4] = '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>';
        $objects[5] = '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold /Encoding /WinAnsiEncoding >>';
        $objects[6] = "<< /Length " . strlen($contentStream) . " >>\nstream\n" . $contentStream . "\nendstream";

        $pdf = "%PDF-1.4\n";
        $offsets = [0 => 0];

        foreach ($objects as $id => $body) {
            $offsets[$id] = strlen($pdf);
            $pdf .= "{$id} 0 obj\n{$body}\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $count = count($objects) + 1;
        $pdf .= "xref\n0 {$count}\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i < $count; $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        $pdf .= "trailer\n<< /Size {$count} /Root 1 0 R >>\n";
        $pdf .= "startxref\n{$xrefOffset}\n%%EOF";

        return $pdf;
    }
}
