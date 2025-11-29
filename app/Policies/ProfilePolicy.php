<?php

namespace App\Policies;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Http\Controllers\PermissionController;

class ProfilePolicy
{

    public function viewAny(User $user): bool
    {
        return PermissionController::isAuthorized('profile.index');
    }
}
