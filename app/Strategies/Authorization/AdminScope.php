<?php

namespace App\Strategies\Authorization;

class AdminScope implements AuthorizationScope
{
    public function apply($query, $user)
    {
        return $query;
    }
}
