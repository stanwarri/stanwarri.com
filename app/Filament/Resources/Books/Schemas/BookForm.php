<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                
                TextInput::make('isbn')
                    ->label('ISBN')
                    ->maxLength(255),
                
                Textarea::make('description')
                    ->rows(3),
                
                TextInput::make('cover_image_url')
                    ->label('Cover Image URL')
                    ->url()
                    ->maxLength(255),
                
                DatePicker::make('purchase_date')
                    ->label('Purchase Date'),
                
                TextInput::make('purchase_price')
                    ->label('Purchase Price')
                    ->numeric()
                    ->prefix('$')
                    ->step(0.01),
                
                TextInput::make('quantity_purchased')
                    ->label('Quantity Purchased')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->minValue(1),
            ]);
    }
}
