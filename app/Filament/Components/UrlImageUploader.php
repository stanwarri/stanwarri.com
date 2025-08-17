<?php

namespace App\Filament\Components;

use Filament\Actions\Action;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;

class UrlImageUploader extends Field
{
    protected string $view = 'filament.components.url-image-uploader';

    protected string $directory = 'images';

    protected bool $shouldPreserveFilenames = false;

    public function directory(string $directory): static
    {
        $this->directory = $directory;

        return $this;
    }

    public function preserveFilenames(bool $condition = true): static
    {
        $this->shouldPreserveFilenames = $condition;

        return $this;
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $fieldName = $this->getName();

        $this->schema([
            Tabs::make('upload_methods')
                ->tabs([
                    Tab::make('upload')
                        ->label('File Upload')
                        ->icon(Heroicon::ArrowUpTray)
                        ->schema([
                            FileUpload::make("{$fieldName}")
                                ->image()
                                ->preserveFilenames($this->shouldPreserveFilenames)
                                ->directory($this->directory)
                                ->disk('public')
                                ->afterStateHydrated(function (Field $component, $state) {
                                    if ($record = $component->getRecord()) {
                                        $value = $record->{$component->getName()};

                                        if (is_string($value)) {
                                            $component->state([$value]);
                                        } elseif (is_array($value)) {
                                            $component->state(array_filter($value));
                                        }
                                    }
                                })
                                ->afterStateUpdated(function ($state, Set $set) use ($fieldName) {
                                    if ($state) {
                                        $uploadedFile = $state ?? null;
                                        if ($uploadedFile instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                                            $filename = $uploadedFile->getClientOriginalName();

                                            // Save file to storage
                                            $path = $uploadedFile->storeAs(
                                                $this->directory,
                                                $filename,
                                                'public'
                                            );

                                            $url = Storage::disk('public')->url($path);
                                            $set("{$fieldName}", [$path]);
                                            $set("{$fieldName}_url", $url);
                                        }
                                    }
                                }),
                        ]),
                    Tab::make('url')
                        ->label('URL Upload')
                        ->icon(Heroicon::GlobeAlt)
                        ->schema([
                            TextInput::make("{$fieldName}_url")
                                ->label('Image URL')
                                ->url()
                                ->placeholder('https://example.com/image.jpg')
                                ->helperText('Enter a valid image URL (JPG, PNG, GIF, WEBP)')
                                ->live()
                                ->afterStateUpdated(function ($state, Set $set) use ($fieldName) {
                                    if (empty($state)) {
                                        $set("{$fieldName}_preview", null);
                                    }
                                }),
                            Actions::make([
                                Action::make('fetch')
                                    ->label('Fetch Image')
                                    ->icon(Heroicon::ArrowDownTray)
                                    ->color('primary')
                                    ->requiresConfirmation(false)
                                    ->action(function (Set $set, Get $get) use ($fieldName) {
                                        $imageUrl = $get("{$fieldName}_url");

                                        if (! $imageUrl || ! filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                                            Notification::make()
                                                ->danger()
                                                ->title('Invalid URL')
                                                ->body('Please enter a valid image URL')
                                                ->send();

                                            return;
                                        }

                                        try {
                                            $context = stream_context_create([
                                                'http' => [
                                                    'method' => 'GET',
                                                    'header' => [
                                                        'User-Agent: Mozilla/5.0 (compatible; Image Fetcher)',
                                                        'Accept: image/*',
                                                    ],
                                                    'timeout' => 30,
                                                ],
                                                'ssl' => [
                                                    'verify_peer' => false,
                                                    'verify_peer_name' => false,
                                                ],
                                            ]);

                                            $imageContent = file_get_contents($imageUrl, false, $context);

                                            if (! $imageContent) {
                                                throw new \Exception('Could not fetch image from URL');
                                            }

                                            // Validate it's actually an image
                                            $imageInfo = getimagesizefromstring($imageContent);
                                            if (! $imageInfo) {
                                                throw new \Exception('URL does not contain a valid image');
                                            }

                                            // Get file extension from URL or image type
                                            $urlPath = parse_url($imageUrl, PHP_URL_PATH);
                                            $extension = pathinfo($urlPath, PATHINFO_EXTENSION);

                                            if (! $extension) {
                                                $mimeToExtension = [
                                                    'image/jpeg' => 'jpg',
                                                    'image/png' => 'png',
                                                    'image/gif' => 'gif',
                                                    'image/webp' => 'webp',
                                                ];
                                                $extension = $mimeToExtension[$imageInfo['mime']] ?? 'jpg';
                                            }

                                            $filename = 'url_image_'.time().'.'.$extension;
                                            $path = "{$this->directory}/{$filename}";

                                            Storage::disk('public')->put($path, $imageContent);

                                            $url = Storage::disk('public')->url($path);
                                            $set($fieldName, [$path]);
                                            $set("{$fieldName}_url", $url);

                                            Notification::make()
                                                ->success()
                                                ->title('Image fetched successfully')
                                                ->body("Image saved as {$filename}")
                                                ->send();

                                        } catch (\Exception $e) {
                                            Notification::make()
                                                ->danger()
                                                ->title('Failed to fetch image')
                                                ->body($e->getMessage())
                                                ->send();
                                        }
                                    }),
                            ])->alignStart(),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function make(?string $name = null): static
    {
        return parent::make($name);
    }
}
