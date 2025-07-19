<?php

namespace App\Filament\Resources\SafetyStockResource\Pages;

use App\Filament\Resources\SafetyStockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSafetyStock extends EditRecord
{
    protected static string $resource = SafetyStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
