<?php

namespace App\Enums;

enum StatusEnum: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }
}