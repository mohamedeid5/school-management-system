<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;

class SubjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view own subjects');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Subject $subject): bool
    {
        if ($user->teacher) {
            return $user->teacher->subjects()->where('subjects.id', $subject->id)->exists();
        }

        if ($user->student) {
            return $user->student->grade_id === $subject->grade_id
                && $user->student->classroom_id === $subject->classroom_id;
        }

        return false;
    }

}
