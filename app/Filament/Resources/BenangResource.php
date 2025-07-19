<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BenangResource\Pages;
use App\Models\Benang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BenangResource extends Resource
{
    protected static ?string $model = Benang::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_benang')->required()->maxLength(255),
                Forms\Components\TextInput::make('warna_benang')->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_benang')->searchable(),
                Tables\Columns\TextColumn::make('warna_benang')->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBenangs::route('/'),
            'create' => Pages\CreateBenang::route('/create'),
            'edit' => Pages\EditBenang::route('/{record}/edit'),
        ];
    }    
}