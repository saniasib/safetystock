<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanResource\Pages;
use App\Models\Laporan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

// 1. Tambahkan use statement yang diperlukan
use App\Models\Produk;
use App\Models\Pesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\DatePicker;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationGroup = 'Laporan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_laporan')->required()->maxLength(255),
                Forms\Components\Select::make('jenis_laporan_id')
                    ->relationship('jenisLaporan', 'nama_jenislaporan')
                    ->required(),
                // Menambahkan input rentang tanggal untuk laporan periodik
                DatePicker::make('tanggal_mulai'),
                DatePicker::make('tanggal_selesai')->afterOrEqual('tanggal_mulai'),
                Forms\Components\DatePicker::make('tanggal_cetak')->required()->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_laporan')->searchable(),
                Tables\Columns\TextColumn::make('jenisLaporan.nama_jenislaporan')->sortable(),
                Tables\Columns\TextColumn::make('tanggal_cetak')->date()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                // 2. Tambahkan Aksi Cetak
                Action::make('cetak')
                    ->label('Cetak')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->action(function (Laporan $record) {
                        $pdf = static::generatePdf($record);
                        
                        if ($pdf) {
                            return response()->streamDownload(
                                fn () => print($pdf->output()),
                                'laporan-' . str($record->nama_laporan)->slug() . '.pdf'
                            );
                        }
                    })
            ]);
    }
    
    // 3. Tambahkan method baru untuk logika generate PDF
    public static function generatePdf(Laporan $record)
    {
        // Cek jenis laporan, lalu buat PDF yang sesuai
        return match ($record->jenisLaporan->nama_jenislaporan) {
            'Stok' => Pdf::loadView('laporan.stok', [
                'produks' => Produk::all(),
                'laporan' => $record,
            ]),
            'Pesanan' => Pdf::loadView('laporan.penjualan', [
                // Menggunakan tanggal_mulai dan tanggal_selesai dari record
                'pesanans' => Pesanan::whereDate('tgl_pesanan', '>=', $record->tanggal_mulai)
                      ->whereDate('tgl_pesanan', '<=', $record->tanggal_selesai)
                      ->get(),
                'laporan' => $record,
                
            ]),
            // 'Safety Stock' => Pdf::loadView('laporan.Safety-Stock', [
            //     // Menggunakan tanggal_mulai dan tanggal_selesai dari record
            //     'pesanans' => Pesanan::whereBetween('created_at', [$record->tanggal_mulai, $record->tanggal_selesai])->get(),
            //     'laporan' => $record,
            // ]),
            // default => null, // Biarkan kosong jika jenis lain belum didukung
        };
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporans::route('/'),
            'create' => Pages\CreateLaporan::route('/create'),
            'edit' => Pages\EditLaporan::route('/{record}/edit'),
        ];
    }    
}