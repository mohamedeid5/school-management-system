<?php

namespace App\Policies;

use App\Models\OnlineClass;
use App\Models\User;

class OnlineClassPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view own online classes');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OnlineClass $onlineClass): bool
    {

        if ($user->teacher) {
            return $user->id === $onlineClass->user_id;
        }

        if ($user->student) {
            return $onlineClass->grade_id === $user->student->grade_id &&
                $onlineClass->classroom_id === $user->student->classroom_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->teacher;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OnlineClass $onlineClass): bool
    {
        return $user->id === $onlineClass->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OnlineClass $onlineClass): bool
    {
        return $user->id === $onlineClass->user_id;
    }

}
