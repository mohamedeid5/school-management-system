<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Loggable
{
    protected function logError(string $message, \Exception $e, array $context = []): void
    {
        $logData = array_merge([
            'user_id' => auth()->id(),
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ], $context);

        Log::error($message, $logData);
    }
}
