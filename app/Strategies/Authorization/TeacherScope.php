<?php

namespace App\Strategies\Authorization;

class TeacherScope implements AuthorizationScope
{
    public function apply($query, $user)
    {
        return $query->where('teacher_id', $user->teacher->id);
    }
}
