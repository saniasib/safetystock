<?php

namespace App\Filament\Resources\PengirimanBahanResource\Pages;

use App\Filament\Resources\PengirimanBahanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengirimanBahans extends ListRecords
{
    protected static string $resource = PengirimanBahanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
