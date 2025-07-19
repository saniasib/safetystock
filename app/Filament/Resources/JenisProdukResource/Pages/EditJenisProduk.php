<?php

namespace App\Filament\Resources\JenisProdukResource\Pages;

use App\Filament\Resources\JenisProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisProduk extends EditRecord
{
    protected static string $resource = JenisProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
