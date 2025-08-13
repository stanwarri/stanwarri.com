<?php

namespace App\Filament\Components;

use Filament\Actions;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Support\Facades\Storage;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Actions as SchemasActions;

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

    public function getChildComponents(?string $key = null): array
    {
        $fieldName = $this->getName();

        return [
            Tabs::make('upload_methods')
                ->tabs([
                    Tab::make('upload')
                        ->label('File Upload')
                        ->icon('heroicon-o-arrow-up-tray')
                        ->schema([
                            FileUpload::make($fieldName)
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
                                        $uploadedFile = is_array($state) ? $state[0] : $state;
                                        if ($uploadedFile instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                                            $filename = $uploadedFile->getClientOriginalName();

                                            $path = $uploadedFile->storeAs(
                                                $this->directory,
                                                $filename,
                                                'public'
                                            );

                                            $url = Storage::disk('public')->url($path);
                                            $set($fieldName, $path);
                                            $set("{$fieldName}_preview", $url);
                                        }
                                    }
                                }),
                        ]),
                    Tab::make('url')
                        ->label('URL Upload')
                        ->icon('heroicon-o-globe-alt')
                        ->schema([
                            TextInput::make("{$fieldName}_url")
                                ->url()
                                ->helperText('Enter a valid image URL (JPG, PNG, GIF, WEBP)'),
                            SchemasActions::make([
                                Actions\Action::make('fetch')
                                    ->label('Fetch Image')
                                    ->icon('heroicon-o-arrow-down-tray')
                                    ->action(function (Set $set, $state) use ($fieldName) {
                                        $imageUrl = $state["{$fieldName}_url"] ?? null;

                                        if (! $imageUrl || ! filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                                            Notification::make()
                                                ->danger()
                                                ->title('Invalid URL')
                                                ->body('Please enter a valid image URL')
                                                ->send();

                                            return;
                                        }

                                        try {
                                            // Get image content with proper headers
                                            $context = stream_context_create([
                                                'http' => [
                                                    'method' => 'GET',
                                                    'header' => [
                                                        'User-Agent: Mozilla/5.0 (compatible; Image Fetcher)',
                                                        'Accept: image/*',
                                                    ],
                                                    'timeout' => 30,
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
                                            $set($fieldName, $path);
                                            $set("{$fieldName}_preview", $url);

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
                            ]),
                        ]),
                ])
                ->columnSpanFull(),
        ];
    }
}
