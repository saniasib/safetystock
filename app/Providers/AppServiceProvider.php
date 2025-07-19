<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{User, Produk, Pesanan, Laporan, SafetyStock};
use App\Policies\{UserPolicy, ProdukPolicy, PesananPolicy, LaporanPolicy, SafetyStockPolicy};
use Illuminate\Support\Facades\Gate; // <-- WAJIB: Import Gate facade

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Produk::class, ProdukPolicy::class);
        Gate::policy(Pesanan::class, PesananPolicy::class);
        Gate::policy(Laporan::class, LaporanPolicy::class);
        Gate::policy(SafetyStock::class, SafetyStockPolicy::class);
    }
}
