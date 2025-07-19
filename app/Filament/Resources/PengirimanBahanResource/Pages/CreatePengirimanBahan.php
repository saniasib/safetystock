<?php

namespace App\Filament\Resources\PengirimanBahanResource\Pages;

use App\Filament\Resources\PengirimanBahanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePengirimanBahan extends CreateRecord
{
    protected static string $resource = PengirimanBahanResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
