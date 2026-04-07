<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Question extends Model
{
    use LogsActivity, HasTranslations;

    public $translatable = ['question'];

    protected $fillable = [
        'exam_id',
        'question',
        'type',
        'marks',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('question')
            ->logOnly(['question', 'type', 'marks', 'exam_id'])
            ->setDescriptionForEvent(fn (string $eventName) => "Question has been {$eventName}");
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
