<?php

namespace App\Enums;

enum ItemTypeEnum: string
{
    case Available = 'Available';
    case Issued    = 'Issued';
    case Scrapped  = 'Scrapped';
    case Refunded  = 'Refunded';
    case Returned  = 'Returned';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }
}
