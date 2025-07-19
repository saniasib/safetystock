<?php

namespace App\Filament\Resources\JenisProdukResource\Pages;

use App\Filament\Resources\JenisProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisProduk extends CreateRecord
{
    protected static string $resource = JenisProdukResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
