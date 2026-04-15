<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;
use App\Traits\HasAttachments;

class Library extends Model
{
    use LogsActivity, HasAttachments, HasTranslations;

    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'user_id',
        'grade_id',
        'classroom_id',
        'section_id',
        'subject_id',
        'description',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('library')
            ->logOnly(['title', 'grade_id', 'classroom_id', 'subject_id'])
            ->setDescriptionForEvent(fn (string $eventName) => "Library has been {$eventName}");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function scopeAuthorizedForUser($query, $user)
    {
        if ($user->can('view libraries')) {
            return $query;
        }

        if($user->hasRole('teacher') && $user->teacher) {
            $teacher = $user->teacher;
            $sectionIds = $teacher->sections()->pluck('sections.id');

            return $query->whereIn('section_id', $sectionIds);
        }

        if($user->hasRole('student') && $user->student) {
            $student = $user->student;

            return $query->where('grade_id', $student->grade_id)
                    ->where('classroom_id', $student->classroom_id);
        }

        return $query->whereRaw('1 = 0');
    }
}
