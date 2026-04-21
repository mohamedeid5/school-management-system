<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;

class Classroom extends Model
{
    use HasTranslations, HasFactory, LogsActivity;

    protected $fillable = ['name', 'grade_id'];

    public array $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
             ->logOnly(['name', 'grade_id'])
             ->logOnlyDirty()
             ->dontSubmitEmptyLogs();
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('all_classrooms');
        });

        static::deleted(function () {
            Cache::forget('all_classrooms');
        });
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
