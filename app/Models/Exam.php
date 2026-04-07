<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

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
        'exam_date',
        'max_score',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('exam')
            ->logOnly(['name', 'type', 'subject_id', 'grade_id', 'classroom_id', 'exam_date', 'max_score'])
            ->setDescriptionForEvent(fn (string $eventName) => "Exam has been {$eventName}");
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
}
