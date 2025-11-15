<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;

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

    public function generateQrCodeSvg(string $data, int $size = 300): string
    {
        $builder = new Builder(
            writer: new SvgWriter,
            data: $data,
            size: $size,
            margin: 10
        );

        $result = $builder->build();

        return $result->getString();
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

    public function generateQrCodeWithLabel(string $data, int $size = 300, string $labelText = 'SCAN ME'): string
    {
        // Generate the QR code
        $builder = new Builder(
            writer: new PngWriter,
            data: $data,
            size: $size,
            margin: 10
        );

        $qrResult = $builder->build();
        $qrImage = imagecreatefromstring($qrResult->getString());

        // Calculate dimensions for the final image with label
        $qrWidth = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);
        $labelHeight = 80; // Height for the label area
        $totalHeight = $qrHeight + $labelHeight;

        // Create a new image with space for QR code and label
        $finalImage = imagecreatetruecolor($qrWidth, $totalHeight);

        // Set background to white
        $white = imagecolorallocate($finalImage, 255, 255, 255);
        $black = imagecolorallocate($finalImage, 0, 0, 0);
        imagefill($finalImage, 0, 0, $white);

        // Copy the QR code to the top of the image
        imagecopy($finalImage, $qrImage, 0, 0, 0, 0, $qrWidth, $qrHeight);

        // Add the label text
        $fontSize = 24;
        $fontFile = base_path('resources/fonts/arial-bold.ttf');

        // If custom font doesn't exist, use built-in font
        if (file_exists($fontFile)) {
            // Calculate text position to center it
            $textBox = imagettfbbox($fontSize, 0, $fontFile, $labelText);
            $textWidth = abs($textBox[4] - $textBox[0]);
            $x = ($qrWidth - $textWidth) / 2;
            $y = $qrHeight + ($labelHeight / 2) + ($fontSize / 2);

            imagettftext($finalImage, $fontSize, 0, $x, $y, $black, $fontFile, $labelText);
        } else {
            // Fallback to built-in font
            $font = 5; // Large built-in font
            $textWidth = imagefontwidth($font) * strlen($labelText);
            $x = ($qrWidth - $textWidth) / 2;
            $y = $qrHeight + ($labelHeight - imagefontheight($font)) / 2;

            imagestring($finalImage, $font, $x, $y, $labelText, $black);
        }

        // Convert to PNG string
        ob_start();
        imagepng($finalImage);
        $imageData = ob_get_clean();

        // Clean up
        imagedestroy($qrImage);
        imagedestroy($finalImage);

        return $imageData;
    }

    public function generateQrCodeWithLabelDataUri(string $data, int $size = 300, string $labelText = 'SCAN ME'): string
    {
        $imageData = $this->generateQrCodeWithLabel($data, $size, $labelText);

        return 'data:image/png;base64,'.base64_encode($imageData);
    }
}
