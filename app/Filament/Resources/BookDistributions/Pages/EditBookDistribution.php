<?php

namespace App\Filament\Resources\BookDistributions\Pages;

use App\Filament\Resources\BookDistributions\BookDistributionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBookDistribution extends EditRecord
{
    protected static string $resource = BookDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
