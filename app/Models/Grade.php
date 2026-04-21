<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;

class Grade extends Model
{
    use HasTranslations, HasFactory, LogsActivity;

    protected $fillable = ['name', 'notes'];

    public array $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
             ->logOnly(['name', 'grade_id'])
             ->logOnlyDirty()
             ->dontSubmitEmptyLogs();
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function scopeAuthorizedForUser($query, $user)
    {
        if($user->hasRole('admin')) {
            return $query->with(['classrooms', 'sections.classroom']);
        }

        $teacher = $user->teacher;

        if (!$teacher) {
            return $query->whereRaw('1 = 0');
        }

        $sectionIds = $teacher->sections()->pluck('sections.id');

        return $query->with(['classrooms', 'sections' => fn($q) => $q->whereIn('id', $sectionIds)->with('classroom')])
            ->whereHas('sections', fn($q) => $q->whereIn('id', $sectionIds));
    }

    public static function booted()
    {
        static::saved(function() {
            Cache::tags(['grades'])->flush();
        });

        static::deleted(function() {
            Cache::tags(['grades'])->flush();
        });
    }

}
