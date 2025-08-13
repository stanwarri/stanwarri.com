<?php

namespace App\Filament\Resources\BookDistributions\Pages;

use App\Filament\Resources\BookDistributions\BookDistributionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBookDistributions extends ListRecords
{
    protected static string $resource = BookDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
