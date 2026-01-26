<?php

namespace App\Enums;

enum ItemTypeEnum: string
{
    case Store    = 'Store';
    case Employee = 'Employee';
    case Purged   = 'Purged';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }
}
