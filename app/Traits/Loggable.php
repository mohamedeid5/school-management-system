<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

trait Loggable
{
    protected function logError(string $message, \Exception $e, array $context = []): void
    {
        $logData = array_merge([
            'user_id' => Auth::id(),
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ], $context);

        Log::error($message, $logData);
    }
}
