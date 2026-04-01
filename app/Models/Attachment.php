<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    protected $fillable = ['file_name', 'attachable_id', 'attachable_type'];

    public function attachable()
    {
        return $this->morphTo();
    }

    public function getFullPathAttribute()
    {
        $folder = strtolower(class_basename($this->attachable_type)) . 's';
        return $folder . '/' . $this->attachable_id . '/' . $this->file_name;
    }

    public function getUrlAttribute()
    {
        return Storage::disk('attachments')->url($this->full_path);
    }
}
