<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SafetyStockResource\Pages;
use App\Models\SafetyStock;
use App\Services\SafetyStockService;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use App\Models\Pesanan; // Asumsi model transaksi penjualan Anda bernama 'Sale'
use Filament\Support\Exceptions\Halt; // Import class Halt

class SafetyStockResource extends Resource
{
    protected static ?string $model = SafetyStock::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $label = 'Safety Stock';
    protected static ?string $pluralLabel = 'Safety Stock';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_laporan')->weight('bold'),
                Tables\Columns\TextColumn::make('user.name')->label('Dibuat Oleh'),
                Tables\Columns\TextColumn::make('tanggal_mulai')->date('d M Y'),
                Tables\Columns\TextColumn::make('tanggal_selesai')->date('d M Y'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('buatLaporan')
                    ->label('Buat Laporan Baru')
                    ->icon('heroicon-o-document-plus')
                    ->form([
                        Forms\Components\TextInput::make('nama_laporan')->label('Nama Laporan / Keterangan')->required(),
                        DatePicker::make('tanggal_mulai')->required(),
                        DatePicker::make('tanggal_selesai')->required()->after('tanggal_mulai'),
                    ])
                    ->action(function (array $data, SafetyStockService $service) {
                        // --- VALIDASI TAMBAHAN DIMULAI DI SINI ---
                        $adaTransaksi = Pesanan::whereBetween('created_at', [$data['tanggal_mulai'], $data['tanggal_selesai']])->exists();

                        if (!$adaTransaksi) {
                            // Tampilkan notifikasi error
                            Notification::make()
                                ->title('Data Transaksi Tidak Ditemukan')
                                ->body('Tidak ada data penjualan pada rentang tanggal yang Anda pilih. Silakan pilih rentang tanggal yang lain.')
                                ->danger()
                                ->send();

                            // Hentikan eksekusi aksi
                            throw new Halt();
                        }
                        // --- VALIDASI SELESAI ---

                        // Jika validasi lolos, lanjutkan proses seperti biasa
                        $hasil = $service->generateCombinedReport($data['tanggal_mulai'], $data['tanggal_selesai']);

                        SafetyStock::create([
                            'nama_laporan' => $data['nama_laporan'],
                            'user_id' => Auth::id(),
                            'tanggal_mulai' => $data['tanggal_mulai'],
                            'tanggal_selesai' => $data['tanggal_selesai'],
                            'hasil_perhitungan' => $hasil,
                        ]);

                        Notification::make()->title('Laporan berhasil dibuat')->success()->send();
                    })
              ]);     
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSafetyStocks::route('/'),
            'view' => Pages\ViewSafetyStock::route('/{record}'),
        ];
    }    
}