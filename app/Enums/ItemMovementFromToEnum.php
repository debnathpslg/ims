<?php

namespace App\Enums;

enum ItemTypeEnum: string
{
    case Store    = 'Store';
    case Employee = 'Employee';
    case Vendor   = 'Vendor';
    case None     = 'None';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }
}
