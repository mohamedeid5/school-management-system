<?php

namespace App\Strategies\Authorization;

class StudentScope implements AuthorizationScope
{
    public function apply($query, $user)
    {
        $student = $user->student;

        return $query->where('grade_id', $student->grade_id)
                    ->where('classroom_id', $student->classroom_id)
                    ->where('exam_date', '>=', now());
    }
}
