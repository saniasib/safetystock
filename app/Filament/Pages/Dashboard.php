<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\PesananChart; // <-- Import widget di sini

class Dashboard extends BaseDashboard
{
    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            PesananChart::class, // <-- Daftarkan widget di sini
        ];
    }
}