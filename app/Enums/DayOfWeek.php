<?php

namespace App\Enums;

enum DayOfWeek: string
{
    case Monday = 'Monday';
    case Tuesday = 'Tuesday';
    case Wednesday = 'Wednesday';
    case Thursday = 'Thursday';
    case Friday = 'Friday';
    case Saturday = 'Saturday';
    case Sunday = 'Sunday';
    
    public function text(): string
    {
        return match ($this) {
            self::Monday => '月曜日',
            self::Tuesday => '火曜日',
            self::Wednesday => '水曜日',
            self::Thursday => '木曜日',
            self::Friday => '金曜日',
            self::Saturday => '土曜日',
            self::Sunday => '日曜日',
        };
    }
}