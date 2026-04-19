<?php

namespace App\Strategies\Authorization;

class DenyAllScope implements AuthorizationScope
{
    public function apply($query, $user)
    {
        return $query->whereRaw('1 = 0');
    }
}
