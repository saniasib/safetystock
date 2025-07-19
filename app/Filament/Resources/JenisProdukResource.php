<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisProdukResource\Pages;
use App\Models\JenisProduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JenisProdukResource extends Resource
{
    protected static ?string $model = JenisProduk::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?string $modelLabel = 'Jenis Produk';
    protected static ?string $pluralModelLabel = 'Jenis Produk';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('jenis_produk')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jenis_produk')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJenisProduks::route('/'),
            'create' => Pages\CreateJenisProduk::route('/create'),
            'edit' => Pages\EditJenisProduk::route('/{record}/edit'),
        ];
    }
}