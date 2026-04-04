<?php

namespace App\Enums;

enum FeeType: int
{
    case TUITION = 1; 
    case BUS     = 2; 
    case BOOKS   = 3; 
    case UNIFORM = 4;

    public function label(): string
    {
        return match($this) {
            self::TUITION => __('main.tuition_fees'),
            self::BUS     => __('main.bus_fees'),
            self::BOOKS   => __('main.books_fees'),
            self::UNIFORM => __('main.uniform_fees'),
        };
    }
}