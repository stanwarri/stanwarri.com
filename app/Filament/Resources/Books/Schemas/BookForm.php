<?php

namespace App\Filament\Resources\Books\Schemas;

use App\Filament\Components\UrlImageUploader;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                TextInput::make('author')
                    ->required()
                    ->maxLength(255),

                TextInput::make('quantity_purchased')
                    ->label('Quantity Purchased')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->minValue(1),

                DatePicker::make('purchase_date')
                    ->label('Purchase Date'),

                Textarea::make('excerpt')
                    ->label('Excerpt')
                    ->helperText('Short summary or preview of the book to display on the books page')
                    ->rows(2)
                    ->columnSpanFull(),

                RichEditor::make('description')
                    ->columnSpanFull(),

                UrlImageUploader::make('cover_image_url')
                    ->label('Cover Image')
                    ->directory('book-covers')
                    ->preserveFilenames(true)
                    ->columnSpanFull(),

                TextInput::make('purchase_price')
                    ->label('Purchase Price')
                    ->numeric()
                    ->prefix('$')
                    ->step(0.01),

                TextInput::make('isbn')
                    ->label('ISBN')
                    ->maxLength(255),

            ]);
    }
}
