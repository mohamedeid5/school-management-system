<?php

namespace App\Enums;

enum ExamType: string
{
    case QUIZ       = 'quiz';
    case MIDTERM    = 'midterm';
    case FINAL      = 'final';
    case ASSIGNMENT = 'assignment';

    public function label(): string
    {
        return match($this) {
            self::QUIZ       => __('main.exam_type_quiz'),
            self::MIDTERM    => __('main.exam_type_midterm'),
            self::FINAL      => __('main.exam_type_final'),
            self::ASSIGNMENT => __('main.exam_type_assignment'),
        };
    }

    public function color(): string
    {
        return match($this) {
            self::QUIZ => 'info',
            self::MIDTERM => 'warning',
            self::FINAL => 'danger',
            self::ASSIGNMENT => 'success'
        };
    }
}
