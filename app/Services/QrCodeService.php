<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeService
{
    public function generateQrCode(string $data, int $size = 300): string
    {
        $builder = new Builder(
            writer: new PngWriter,
            data: $data,
            size: $size,
            margin: 10
        );

        $result = $builder->build();

        return $result->getDataUri();
    }

    public function generateQrCodeForDistribution(string $qrCode): string
    {
        $url = url("/join/{$qrCode}");

        return $this->generateQrCode($url);
    }

    public function generateQrCodeImage(string $data, int $size = 300): string
    {
        $builder = new Builder(
            writer: new PngWriter,
            data: $data,
            size: $size,
            margin: 10
        );

        $result = $builder->build();

        return $result->getString();
    }

    public function generatePrintableQrCode(string $qrCode, array $bookInfo): array
    {
        $url = url("/join/{$qrCode}");
        $qrDataUri = $this->generateQrCode($url, 200);

        return [
            'qr_code' => $qrCode,
            'url' => $url,
            'qr_image' => $qrDataUri,
            'book_title' => $bookInfo['title'] ?? '',
            'book_author' => $bookInfo['author'] ?? '',
        ];
    }
}
