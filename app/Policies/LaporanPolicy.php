<?php

namespace App\Policies;

use App\Models\Laporan;
use App\Models\User;

class LaporanPolicy
{
    // Siapa yang boleh melihat daftar laporan? -> Admin dan Pemilik
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pemilik']);
    }
    
    // Siapa yang boleh membuat/mengedit/menghapus? -> Admin dan Pemilik
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'pemilik']);
    }

    public function update(User $user, Laporan $model): bool
    {
        return in_array($user->role, ['admin', 'pemilik']);
    }

    public function delete(User $user, Laporan $model): bool
    {
        return in_array($user->role, ['admin', 'pemilik']);
    }
}