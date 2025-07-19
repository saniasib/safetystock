<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\ProdukResource\RelationManagers\StokRelationManager;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_produk')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lead_time_hari')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('jenis_produk_id')
                    ->relationship('jenisProduk', 'jenis_produk')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_produk')->searchable(),
                Tables\Columns\TextColumn::make('jenisProduk.jenis_produk')->sortable(),
                Tables\Columns\TextColumn::make('lead_time_hari')->label('Lead Time (Hari)')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                
            ]);
    }
    public static function getRelations(): array
    {
        return [
            StokRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
    
}