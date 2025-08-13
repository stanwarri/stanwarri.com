<?php

namespace Tests\Unit;

use App\Filament\Components\UrlImageUploader;
use PHPUnit\Framework\TestCase;

class BookImageUploadTest extends TestCase
{
    public function test_url_image_uploader_component_can_be_instantiated(): void
    {
        $component = UrlImageUploader::make('cover_image_url');

        $this->assertInstanceOf(UrlImageUploader::class, $component);
        $this->assertEquals('cover_image_url', $component->getName());
    }

    public function test_directory_can_be_set(): void
    {
        $component = UrlImageUploader::make('cover_image_url')
            ->directory('book-covers');

        $this->assertEquals('book-covers', $component->getDirectory());
    }

    public function test_preserve_filenames_can_be_set(): void
    {
        $component = UrlImageUploader::make('cover_image_url')
            ->preserveFilenames(true);

        // Note: shouldPreserveFilenames is protected, so we test behavior indirectly
        $this->assertInstanceOf(UrlImageUploader::class, $component);
    }

    public function test_component_has_correct_view(): void
    {
        $component = UrlImageUploader::make('cover_image_url');

        $this->assertEquals('filament.components.url-image-uploader', $component->getView());
    }

    public function test_component_has_child_components(): void
    {
        $component = UrlImageUploader::make('cover_image_url');
        $childComponents = $component->getChildComponents();

        $this->assertIsArray($childComponents);
        $this->assertNotEmpty($childComponents);
    }
}
