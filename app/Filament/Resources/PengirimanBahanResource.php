<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengirimanBahanResource\Pages;
use App\Models\PengirimanBahan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;

class PengirimanBahanResource extends Resource
{
    protected static ?string $model = PengirimanBahan::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $label = 'Histori Pengiriman';
    protected static ?string $pluralLabel = 'Histori Pengiriman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('produk_id')
                    ->relationship('produk', 'nama_produk')
                    ->searchable()
                    ->preload()
                    ->required(),
                // Menggunakan 'tanggal_pemesanan' sesuai model Anda
                DatePicker::make('tanggal_pemesanan')
                    ->label('Tanggal Pemesanan')
                    ->required(),
                // Menggunakan 'tanggal_penerimaan' sesuai model Anda
                DatePicker::make('tanggal_penerimaan')
                    ->label('Tanggal Penerimaan')
                    ->required()
                    ->afterOrEqual('tanggal_pemesanan'),
                Forms\Components\Textarea::make('keterangan') // Menambahkan kolom keterangan jika diperlukan
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('produk.nama_produk')
                    ->searchable()
                    ->sortable(),
                // Menampilkan 'tanggal_pemesanan'
                Tables\Columns\TextColumn::make('tanggal_pemesanan')
                    ->date('d M Y')
                    ->sortable(),
                // Menampilkan 'tanggal_penerimaan'
                Tables\Columns\TextColumn::make('tanggal_penerimaan')
                    ->date('d M Y')
                    ->sortable(),
                // Menampilkan 'lead_time_aktual_hari' yang dihitung otomatis oleh database
                Tables\Columns\TextColumn::make('lead_time_aktual_hari')
                    ->label('Lead Time (Hari)')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('produk_id')
                    ->label('Produk')
                    ->relationship('produk', 'nama_produk')
                    ->searchable()
                    ->preload(),
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
            'index' => Pages\ListPengirimanBahans::route('/'),
            'create' => Pages\CreatePengirimanBahan::route('/create'),
            'edit' => Pages\EditPengirimanBahan::route('/{record}/edit'),
        ];
    }    
}