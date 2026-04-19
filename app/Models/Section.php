<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Translatable\HasTranslations;


class Section extends Model
{

    use LogsActivity, HasTranslations;

    protected $fillable = ['name', 'status','grade_id', 'classroom_id'];

    public array $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
             ->logOnly(['name', 'grade_id'])
             ->logOnlyDirty()
             ->dontSubmitEmptyLogs();
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public static function booted()
    {
        $clearCache = function() {
            Cache::forget('all_teachers');
            Cache::forget('all_classrooms');
        };

        static::saved($clearCache);
        static::deleted($clearCache);
    }

}
