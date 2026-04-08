<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Attachment extends Model
{
    protected $fillable = ['file_name', 'attachable_id', 'attachable_type'];

    public function attachable()
    {
        return $this->morphTo();
    }

    public function getFullPathAttribute()
    {
        $folder = Str::plural(Str::lower(class_basename($this->attachable_type)));
        return $folder . '/' . $this->attachable_id . '/' . $this->file_name;
    }

    public function getUrlAttribute()
    {
        return Storage::disk('attachments')->url($this->full_path);
    }
}
