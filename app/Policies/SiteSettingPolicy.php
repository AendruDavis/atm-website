<?php

namespace App\Policies;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SiteSettingPolicy extends ContentPolicy
{
    public function create(User $user): bool
    {
        return $user->canManageContent() && SiteSetting::query()->doesntExist();
    }

    public function delete(User $user, Model $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, Model $model): bool
    {
        return false;
    }
}
