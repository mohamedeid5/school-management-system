<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAttachments;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasAttachments;

    protected $fillable = [
        'key',
        'value'
    ];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function getAttachmentUrl()
    {
        $attachment = $this->attachments()->first();

        if($attachment) {

            $folder = Str::plural(strtolower(class_basename($this)));

            $path = "{$folder}/{$attachment->attachable_id}/{$attachment->file_name}";

            if(Storage::disk('attachments')->exists($path)) {
                return Storage::disk('attachments')->url($path);
            }
        }

    }
}
