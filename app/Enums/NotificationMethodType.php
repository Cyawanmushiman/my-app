<?php

namespace App\Enums;

enum NotificationMethodType: int
{
    case Email = 1;
    case Line = 2;
    
    public function text(): string
    {
        return match ($this) {
            self::Email => 'Email',
            self::Line => 'LINE',
        };
    }
}