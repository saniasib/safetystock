<?php

namespace App\Policies;

use App\Models\Benang;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BenangPolicy
{
    /**
     * Determine whether the user can view any models.
     * Siapa yang boleh melihat daftar benang? -> Admin dan Pemilik
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can view the model.
     * Siapa yang boleh melihat detail benang? -> Admin dan Pemilik
     */
    public function view(User $user, Benang $benang): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can create models.
     * Siapa yang boleh membuat data benang baru? -> Admin dan Pemilik
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can update the model.
     * Siapa yang boleh mengedit data benang? -> Admin dan Pemilik
     */
    public function update(User $user, Benang $benang): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can delete the model.
     * Siapa yang boleh menghapus data benang? -> Admin dan Pemilik
     */
    public function delete(User $user, Benang $benang): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Benang $benang): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Benang $benang): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }
}
