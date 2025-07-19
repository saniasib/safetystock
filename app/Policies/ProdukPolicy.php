<?php

namespace App\Policies;

use App\Models\Produk;
use App\Models\User;

class ProdukPolicy
{
    // Siapa yang boleh melihat daftar produk? -> Admin dan Produksi & Gudang
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'produksi_gudang']);
    }
    
    // Siapa yang boleh membuat/mengedit/menghapus? -> Admin dan Produksi & Gudang
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'produksi_gudang']);
    }

    public function update(User $user, Produk $model): bool
    {
        return in_array($user->role, ['admin', 'produksi_gudang']);
    }

    public function delete(User $user, Produk $model): bool
    {
        return in_array($user->role, ['admin', 'produksi_gudang']);
    }
}