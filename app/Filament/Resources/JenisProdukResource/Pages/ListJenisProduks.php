<?php

namespace App\Filament\Resources\JenisProdukResource\Pages;

use App\Filament\Resources\JenisProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisProduks extends ListRecords
{
    protected static string $resource = JenisProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
