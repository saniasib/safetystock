<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisLaporanResource\Pages;
use App\Models\JenisLaporan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JenisLaporanResource extends Resource
{
    protected static ?string $model = JenisLaporan::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $modelLabel = 'Jenis Laporan';
    protected static ?string $pluralModelLabel = 'Jenis Laporan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_jenislaporan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_jenislaporan')->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJenisLaporans::route('/'),
            'create' => Pages\CreateJenisLaporan::route('/create'),
            'edit' => Pages\EditJenisLaporan::route('/{record}/edit'),
        ];
    }    
}