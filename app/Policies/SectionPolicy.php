<?php

namespace App\Policies;

use App\Models\Section;
use App\Models\User;


class SectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view own sections');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Section $section): bool
    {
        if($user->teacher) {
            return $user->teacher->sections()->where('sections.id', $section->id)->exists();
        }
        return false;
    }
}
