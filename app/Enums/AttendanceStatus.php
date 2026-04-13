<?php

namespace App\Enums;

enum AttendanceStatus: string
{
    case PRESENT = 'present';
    case ABSENT = 'absent';
    case LATE = 'late';
    case EXCUSED = 'excused';

    public function label(): string
    {
        return match($this) {
            self::PRESENT => __('main.present_today'),
            self::ABSENT  => __('main.absent_today'),
            self::LATE    => __('main.late_today'),
            self::EXCUSED => __('main.excused_today'),
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PRESENT => 'badge-success',
            self::ABSENT  => 'badge-danger',
            self::LATE    => 'badge-warning',
            self::EXCUSED => 'badge-info',
        };
    }
}
