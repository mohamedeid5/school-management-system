<?php

namespace App\Strategies\Authorization;

class GradeScopeResolver
{
    private array $strategies = [
        'admin'   => AdminScope::class,
        'teacher' => TeacherScope::class,
        'student' => StudentScope::class,
    ];

    public function resolve($user)
    {
        foreach($this->strategies as $role => $strategy) {
            if($user->hasRole($role)) {
                return app($strategy);
            }
        }

        return app(DenyAllScope::class);
    }
}
