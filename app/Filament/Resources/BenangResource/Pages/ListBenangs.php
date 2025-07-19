<?php

namespace App\Filament\Resources\BenangResource\Pages;

use App\Filament\Resources\BenangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBenangs extends ListRecords
{
    protected static string $resource = BenangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
