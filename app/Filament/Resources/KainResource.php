<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KainResource\Pages;
use App\Models\Kain;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KainResource extends Resource
{
    protected static ?string $model = Kain::class;
    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kain')->required()->maxLength(255),
                Forms\Components\TextInput::make('warna_kain')->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kain')->searchable(),
                Tables\Columns\TextColumn::make('warna_kain')->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKains::route('/'),
            'create' => Pages\CreateKain::route('/create'),
            'edit' => Pages\EditKain::route('/{record}/edit'),
        ];
    }
}