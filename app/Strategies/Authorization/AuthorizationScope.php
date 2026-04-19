<?php

namespace App\Strategies\Authorization;

interface AuthorizationScope
{
    public function apply($query, $user);
}
