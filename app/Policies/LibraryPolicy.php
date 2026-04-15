<?php

namespace App\Policies;

use App\Models\Library;
use App\Models\User;

class LibraryPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->can('view libraries') || $user->can('view own libraries');
    }

    public function view(User $user, Library $library): bool
    {
        if ($user->can('view libraries')) {
            return true;
        }

        if ($user->hasRole('student') || $user->hasRole('parent')) {
            return $library->grade_id === $user->student->grade_id
                && $library->classroom_id === $user->student->classroom_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create library');

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Library $library): bool
    {

        if ($user->can('edit library')) {
            return $user->id === $library->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Library $library): bool
    {

        if($user->teacher) {
            return $user->id === $library->user_id;
        }

        return false;
    }
}
