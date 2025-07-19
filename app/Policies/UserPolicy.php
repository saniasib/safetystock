<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // Siapa yang boleh melihat daftar user? -> Admin dan Pemilik
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pemilik']);
    }

    // Siapa yang boleh melihat detail user? -> Admin dan Pemilik
    public function view(User $user, User $model): bool
    {
        return in_array($user->role, ['admin', 'pemilik']);
    }

    // Siapa yang boleh membuat user baru? -> Admin dan Pemilik
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'pemilik']);
    }

    // Siapa yang boleh mengedit user? -> Admin dan Pemilik
    public function update(User $user, User $model): bool
    {
        return in_array($user->role, ['admin', 'pemilik']);
    }

    // Siapa yang boleh menghapus user? -> Admin dan Pemilik
    public function delete(User $user, User $model): bool
    {
        return in_array($user->role, ['admin', 'pemilik']);
    }
}