<?php

namespace App\Enums;

enum QuestionType: string
{
    case MULTIPLE_CHOICE = 'multiple_choice';
    case TRUE_FALSE      = 'true_false';
    case SHORT_ANSWER    = 'short_answer';

    public function label(): string
    {
        return match($this) {
            self::MULTIPLE_CHOICE => __('main.question_type_multiple_choice'),
            self::TRUE_FALSE      => __('main.question_type_true_false'),
            self::SHORT_ANSWER    => __('main.question_type_short_answer'),
        };
    }
}
