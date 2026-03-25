<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentAttachment extends Model
{
    use SoftDeletes;

    protected $fillable = ['file_name', 'parent_id'];
}
