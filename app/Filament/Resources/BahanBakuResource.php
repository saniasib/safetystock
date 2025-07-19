<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BahanBakuResource\Pages;
use App\Models\BahanBaku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BahanBakuResource extends Resource
{
    protected static ?string $model = BahanBaku::class;
    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?string $modelLabel = 'Bahan Baku';
    protected static ?string $pluralModelLabel = 'Bahan Baku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kain_id')
                    ->relationship('kain')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nama_kain} - {$record->warna_kain}")
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('benang_id')
                    ->relationship('benang')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nama_benang} - {$record->warna_benang}")
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kain.nama_kain')->label('Kain')->searchable(),
                Tables\Columns\TextColumn::make('kain.warna_kain')->label('Warna Kain')->searchable(),
                Tables\Columns\TextColumn::make('benang.nama_benang')->label('Benang')->searchable(),
                Tables\Columns\TextColumn::make('benang.warna_benang')->label('Warna Benang')->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBahanBakus::route('/'),
            'create' => Pages\CreateBahanBaku::route('/create'),
            'edit' => Pages\EditBahanBaku::route('/{record}/edit'),
        ];
    }    
}