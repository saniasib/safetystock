<?php

namespace App\Policies;

use App\Models\BahanBaku;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BahanBakuPolicy
{
    /**
     * Determine whether the user can view any models.
     * Siapa yang boleh melihat daftar bahan baku? -> Admin dan Pemilik
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**'admin','produksi_gudang','pemilik'
     * Determine whether the user can view the model.
     * Siapa yang boleh melihat detail bahan baku? -> Admin dan Pemilik
     */
    public function view(User $user, BahanBaku $bahanBaku): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can create models.
     * Siapa yang boleh membuat bahan baku baru? -> Admin dan Pemilik
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can update the model.
     * Siapa yang boleh mengedit bahan baku? -> Admin dan Pemilik
     */
    public function update(User $user, BahanBaku $bahanBaku): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can delete the model.
     * Siapa yang boleh menghapus bahan baku? -> Admin dan Pemilik
     */
    public function delete(User $user, BahanBaku $bahanBaku): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BahanBaku $bahanBaku): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BahanBaku $bahanBaku): bool
    {
        return in_array($user->role, ['produksi_gudang']);
    }
}