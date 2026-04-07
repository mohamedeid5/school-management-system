<?php

namespace App\Enums;

enum ExamType: string
{
    case QUIZ    = 'quiz';
    case MIDTERM = 'midterm';
    case FINAL   = 'final';
    case OTHER   = 'other';

    public function label(): string
    {
        return match($this) {
            self::QUIZ    => __('main.exam_type_quiz'),
            self::MIDTERM => __('main.exam_type_midterm'),
            self::FINAL   => __('main.exam_type_final'),
            self::OTHER   => __('main.exam_type_other'),
        };
    }
}
