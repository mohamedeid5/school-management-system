<?php

namespace App\Models;

use App\Enums\ExamType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;
use App\Models\Question;
use App\Models\Teacher;

class Exam extends Model
{
    use LogsActivity, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'type',
        'subject_id',
        'grade_id',
        'classroom_id',
        'teacher_id',
        'academic_year',
        'term',
        'exam_date',
        'max_score',
    ];

    protected $casts = [
        'type' => ExamType::class,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('exam')
            ->logOnly(['name', 'type', 'subject_id', 'grade_id', 'classroom_id', 'teacher_id', 'academic_year', 'term', 'exam_date', 'max_score'])
            ->setDescriptionForEvent(fn (string $eventName) => "Exam has been {$eventName}");
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function scopeAuthorizedForUser($query, $user)
    {
        if($user->hasRole('teacher')) {
            return $query->where('teacher_id', $user->teacher->id);
        }

        if($user->hasRole('student')) {

            $student = $user->student;

            return $query->where('grade_id', $student->grade_id)
                         ->where('classroom_id', $student->classroom_id)
                         ->where('exam_date', '>=', now());
        }

        return $query;
    }
}
