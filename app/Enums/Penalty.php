<?php

namespace App\Enums;

enum Penalty: string
{
    // ・設定を再調整して再挑戦
    // ・ボスのHPと自分のHPをリセットして再挑戦
    // ・引き続きこのまま再挑戦
    
    case RetryWithReadjustment = '設定を再調整して再挑戦';
    case RetryWithReset = 'ボスのHPと自分のHPをリセットして再挑戦';
    case RetryWithCurrentStatus = '引き続きこのまま再挑戦';
    
    public static function toSelectArray(): array
    {
        return [
            self::RetryWithReadjustment => self::RetryWithReadjustment,
            self::RetryWithReset => self::RetryWithReset,
            self::RetryWithCurrentStatus => self::RetryWithCurrentStatus,
        ];
    }
    
    public static function toSelectArrayWithEmpty(): array
    {
        return ['' => ''] + self::toSelectArray();
    }
}