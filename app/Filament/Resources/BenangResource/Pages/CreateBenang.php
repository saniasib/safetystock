<?php

namespace App\Filament\Resources\BenangResource\Pages;

use App\Filament\Resources\BenangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBenang extends CreateRecord
{
    protected static string $resource = BenangResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
