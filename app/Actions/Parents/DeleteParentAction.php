<?php

namespace App\Actions\Parents;

use App\Models\MyParent;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Events\ParentCreated;
use Illuminate\Support\Facades\Storage;

class DeleteParentAction
{
    public function handle(MyParent $parent)
    {
        $parent->delete();
    }

    public function forceDelete(MyParent $parent)
    {
        if (Storage::disk('parent_attachments')->exists($parent->id)) {
            Storage::disk('parent_attachments')->deleteDirectory($parent->id);
        }
        $parent->forceDelete();
    }
}
