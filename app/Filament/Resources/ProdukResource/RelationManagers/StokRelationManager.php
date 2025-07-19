<?php

namespace App\Filament\Resources\ProdukResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class StokRelationManager extends RelationManager
{
    protected static string $relationship = 'stok';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('jumlah')
            ->columns([
                Tables\Columns\TextColumn::make('jumlah'),
                Tables\Columns\TextColumn::make('updated_at')->label('Terakhir Diperbarui')->dateTime(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}