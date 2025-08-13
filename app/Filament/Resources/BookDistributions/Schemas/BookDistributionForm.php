<?php

namespace App\Filament\Resources\BookDistributions\Schemas;

use App\Models\Book;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BookDistributionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('book_id')
                    ->label('Book')
                    ->relationship('book', 'title')
                    ->required()
                    ->searchable()
                    ->getOptionLabelFromRecordUsing(fn (Book $record): string => "{$record->title} by {$record->author}"),
                
                TextInput::make('qr_code')
                    ->label('QR Code')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->default(fn () => Str::random(20))
                    ->helperText('Auto-generated unique code for this distribution'),
                
                DatePicker::make('distribution_date')
                    ->label('Distribution Date'),
                
                TextInput::make('distribution_location')
                    ->label('Distribution Location')
                    ->maxLength(255),
                
                Textarea::make('notes')
                    ->rows(3),
                
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'distributed' => 'Distributed',
                        'registered' => 'Registered',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
