<?php

namespace App\Enums;

enum StatusEnum: string
{
    case Paid = 'Paid';
    case Pending = 'Pending';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }
}