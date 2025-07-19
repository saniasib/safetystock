<?php

namespace App\Filament\Resources\KainResource\Pages;

use App\Filament\Resources\KainResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKain extends CreateRecord
{
    protected static string $resource = KainResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
