<?php

namespace App\Filament\Resources\BookDistributions;

use App\Filament\Resources\BookDistributions\Pages\CreateBookDistribution;
use App\Filament\Resources\BookDistributions\Pages\EditBookDistribution;
use App\Filament\Resources\BookDistributions\Pages\ListBookDistributions;
use App\Filament\Resources\BookDistributions\Schemas\BookDistributionForm;
use App\Filament\Resources\BookDistributions\Tables\BookDistributionsTable;
use App\Models\BookDistribution;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BookDistributionResource extends Resource
{
    protected static ?string $model = BookDistribution::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQrCode;

    protected static ?string $navigationLabel = 'Distributions';

    public static function form(Schema $schema): Schema
    {
        return BookDistributionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookDistributionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookDistributions::route('/'),
            'create' => CreateBookDistribution::route('/create'),
            'edit' => EditBookDistribution::route('/{record}/edit'),
        ];
    }
}
