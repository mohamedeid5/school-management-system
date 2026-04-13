<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

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
        if ($user->hasRole('teacher')) {
            $teacher    = $user->teacher;
            $sectionIds = $teacher ? $teacher->sections()->pluck('sections.id') : collect();

            return $query->with(['sections' => fn($q) => $q->whereIn('id', $sectionIds)->with('classroom')])
                ->whereHas('sections', fn($q) => $q->whereIn('id', $sectionIds));
        }
        return $query->with(['sections.classroom']);
    }

}
