<?php

namespace App\Filament\Resources\BenangResource\Pages;

use App\Filament\Resources\BenangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBenang extends EditRecord
{
    protected static string $resource = BenangResource::class;

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
