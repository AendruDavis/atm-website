<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

abstract class EnquiryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->canManageEnquiries();
    }

    public function view(User $user, Model $model): bool
    {
        return $user->canManageEnquiries();
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Model $model): bool
    {
        return $user->canManageEnquiries();
    }

    public function delete(User $user, Model $model): bool
    {
        return $user->isSuperAdmin();
    }

    public function restore(User $user, Model $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, Model $model): bool
    {
        return false;
    }
}
