<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\User;

class ExamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view own exams');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Exam $exam): bool
    {

        if($user->teacher) {
            return $user->teacher->exams()->where('exams.id', $exam->id)->exists();
        }

        if($user->student) {
            return $user->student->grade_id === $exam->grade_id &&
               $user->student->classroom_id === $exam->classroom_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create exams');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Exam $exam): bool
    {
        if($user->teacher) {
            return $user->teacher->exams()->where('exams.id', $exam->id)->exists();
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Exam $exam): bool
    {
        if($user->teacher) {
            return $user->teacher->exams()->where('exams.id', $exam->id)->exists();
        }
        return false;
    }

}
