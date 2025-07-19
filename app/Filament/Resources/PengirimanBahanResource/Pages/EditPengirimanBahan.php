<?php

namespace App\Filament\Resources\PengirimanBahanResource\Pages;

use App\Filament\Resources\PengirimanBahanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengirimanBahan extends EditRecord
{
    protected static string $resource = PengirimanBahanResource::class;

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
