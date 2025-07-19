<?php

namespace App\Filament\Resources\SafetyStockResource\Pages;

use App\Filament\Resources\SafetyStockResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
class ViewSafetyStock extends ViewRecord
{
    protected static string $resource = SafetyStockResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Informasi Laporan')->schema([
                    Components\Grid::make(3)->schema([
                        Components\TextEntry::make('nama_laporan'),
                        Components\TextEntry::make('user.name')->label('Dibuat Oleh'),
                        Components\TextEntry::make('created_at')->label('Dibuat Pada')->dateTime(),
                    ]),
                    Components\Grid::make(2)->schema([
                        Components\TextEntry::make('tanggal_mulai')->date('d M Y'),
                        Components\TextEntry::make('tanggal_selesai')->date('d M Y'),
                    ]),
                ]),
                
                Components\Section::make('Rekapitulasi Hasil Perhitungan')
                    ->schema([
                        Components\TextEntry::make('info_data_kosong')
                    ->label('')
                        ->state('Status "Data Tidak Lengkap" muncul karena sistem tidak menemukan riwayat transaksi (penjualan dan pembelian) untuk produk ini pada rentang tanggal laporan.')                    ->visible(function ($record) {
                        // Cek salah satu item di hasil_perhitungan
                        // Logika ini mungkin perlu disesuaikan dengan struktur data 'hasil_perhitungan' Anda
                        if (is_array($record->hasil_perhitungan) && count($record->hasil_perhitungan) > 0) {
                            return $record->hasil_perhitungan[0]['status'] === 'Data Tidak Lengkap';
                        }
                        return false;
                    })
                    ->columnSpanFull(),
                            Components\RepeatableEntry::make('hasil_perhitungan')
                                ->label('')
                                ->schema([
                                    Components\TextEntry::make('produk_nama')
                                        ->label('Nama Produk')
                                        ->weight('bold')
                                        ->columnSpan(2),
                                    Components\TextEntry::make('safety_stock')
                                        ->label('Safety Stock (SS)')
                                        ->badge()->color('primary'),
                                    Components\TextEntry::make('rop')
                                        ->label('Reorder Point (ROP)')
                                        ->badge()->color('warning'),
                                    Components\TextEntry::make('Dmax')->label('Dmax'),
                                    Components\TextEntry::make('Davg')->label('Davg'),
                                    Components\TextEntry::make('Lmax')->label('Lmax'),
                                    Components\TextEntry::make('Lavg')->label('Lavg'),
                                    Components\TextEntry::make('status')
                                        ->badge()
                                        ->color(fn (string $state): string => match ($state) {
                                            'OK' => 'success',
                                            'Data Tidak Lengkap' => 'danger',
                                        })
                                        ->columnSpanFull(),
                                ])
                                ->columns(4)
                        ])
            ]);
    }
}
