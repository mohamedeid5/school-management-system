<?php

namespace App\Actions\Parents;

use App\Models\MyParent;
use Illuminate\Support\Facades\Cache;

class GetParentAction
{
    public function handle(bool $showTrashed)
    {
        $parentsCacheKey = $showTrashed ? 'trashed_parents' : 'active_parents';

        return Cache::rememberForever($parentsCacheKey, function() use ($showTrashed) {

            return $showTrashed
                ? MyParent::onlyTrashed()->with('user')->latest()->get()
                : MyParent::with('user')->latest()->get();
        });
    }
}
