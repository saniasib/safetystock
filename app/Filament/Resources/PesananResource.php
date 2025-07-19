<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Models\Pesanan;
use App\Models\Produk; // Import model Produk
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get; // Import Get
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('produk_id')
                    ->relationship('produk', 'nama_produk')
                    ->searchable()
                    ->preload()
                    ->live() // Tambahkan live() agar form reaktif
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    // Tambahkan validasi custom di sini
                    ->rule(function (Get $get, $state) {
                        return function (string $attribute, $value, \Closure $fail) use ($get) {
                            $produkId = $get('produk_id');
                            if (!$produkId) {
                                return; // Jika produk belum dipilih, lewati validasi
                            }

                            $produk = Produk::find($produkId);
                            // Cek apakah stok cukup
                            if ($produk && $produk->stok && $produk->stok->jumlah < $value) {
                                $fail("Stok untuk {$produk->nama_produk} tidak mencukupi. Stok tersedia: {$produk->stok->jumlah}.");
                            }
                        };
                    }),
                Forms\Components\DatePicker::make('tgl_pesanan')
                    ->required(),
                Forms\Components\DatePicker::make('tgl_awal')
                    ->required(),
                Forms\Components\DatePicker::make('tgl_akhir')
                    ->required(),
                Forms\Components\TextInput::make('nama_pemesan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('no_tlphn')
                    ->tel()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pemesan')->searchable(),
                Tables\Columns\TextColumn::make('produk.nama_produk')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('jumlah'),
                Tables\Columns\TextColumn::make('tgl_pesanan')->date()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tambahkan action hapus agar kita bisa menangani pengembalian stok
                Tables\Actions\DeleteAction::make()
                    ->after(function (Pesanan $record) {
                        // Kembalikan stok setelah pesanan dihapus
                        if ($record->produk && $record->produk->stok) {
                            $record->produk->stok->increment('jumlah', $record->jumlah);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->after(function (\Illuminate\Database\Eloquent\Collection $records) {
                            // Kembalikan stok untuk setiap pesanan yang dihapus massal
                            foreach ($records as $record) {
                                if ($record->produk && $record->produk->stok) {
                                    $record->produk->stok->increment('jumlah', $record->jumlah);
                                }
                            }
                        }),
                ]),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }      
}