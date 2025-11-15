<?php

namespace App\Filament\Pages;

use App\Services\QrCodeService;
use BackedEnum;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Response;

/**
 * @property-read Schema $form
 */
class CommunityQrCode extends Page
{
    protected string $view = 'filament.pages.community-qr-code';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::QrCode;

    protected static ?string $navigationLabel = 'Community QR Code';

    protected static ?string $title = 'Community Signup QR Code';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'size' => 300,
            'format' => 'png',
            'color' => 'black',
            'include_label' => false,
            'label_text' => 'SCAN ME',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('QR Code Options')
                    ->description('Customize the QR code for the community signup page.')
                    ->schema([
                        Select::make('size')
                            ->label('QR Code Size')
                            ->options([
                                200 => 'Small (200px)',
                                300 => 'Medium (300px)',
                                400 => 'Large (400px)',
                                500 => 'Extra Large (500px)',
                            ])
                            ->default(300)
                            ->required()
                            ->live(),
                        Radio::make('format')
                            ->label('Download Format')
                            ->options([
                                'png' => 'PNG Image',
                                'svg' => 'SVG Vector',
                            ])
                            ->default('png')
                            ->required()
                            ->inline(),
                        Radio::make('color')
                            ->label('QR Code Style')
                            ->options([
                                'black' => 'Black (Default)',
                                'blue' => 'Blue',
                                'green' => 'Green',
                            ])
                            ->default('black')
                            ->required()
                            ->inline(),
                        Checkbox::make('include_label')
                            ->label('Include "SCAN ME" Label')
                            ->helperText('Add a label below the QR code for better visibility')
                            ->default(false)
                            ->live(),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    public function getQrCodeDataUri(): string
    {
        $qrCodeService = app(QrCodeService::class);
        $url = url('/community/signup');
        $size = $this->data['size'] ?? 300;
        $includeLabel = $this->data['include_label'] ?? false;
        $labelText = $this->data['label_text'] ?? 'SCAN ME';

        if ($includeLabel) {
            return $qrCodeService->generateQrCodeWithLabelDataUri($url, $size, $labelText);
        }

        return $qrCodeService->generateQrCode($url, $size);
    }

    public function downloadQrCode(): \Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\StreamedResponse
    {
        $qrCodeService = app(QrCodeService::class);
        $url = url('/community/signup');
        $size = $this->data['size'] ?? 300;
        $format = $this->data['format'] ?? 'png';
        $includeLabel = $this->data['include_label'] ?? false;
        $labelText = $this->data['label_text'] ?? 'SCAN ME';

        if ($format === 'svg') {
            // SVG doesn't support labels yet, so just generate regular QR code
            $svgContent = $qrCodeService->generateQrCodeSvg($url, $size);

            Notification::make()
                ->title('QR Code Downloaded')
                ->success()
                ->send();

            return Response::streamDownload(function () use ($svgContent) {
                echo $svgContent;
            }, 'community-signup-qr-code.svg', [
                'Content-Type' => 'image/svg+xml',
            ]);
        }

        // Generate PNG with or without label
        if ($includeLabel) {
            $imageContent = $qrCodeService->generateQrCodeWithLabel($url, $size, $labelText);
        } else {
            $imageContent = $qrCodeService->generateQrCodeImage($url, $size);
        }

        Notification::make()
            ->title('QR Code Downloaded')
            ->success()
            ->send();

        return Response::streamDownload(function () use ($imageContent) {
            echo $imageContent;
        }, 'community-signup-qr-code.png', [
            'Content-Type' => 'image/png',
        ]);
    }
}
