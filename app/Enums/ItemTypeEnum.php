<?php

namespace App\Enums;

enum ItemTypeEnum: string
{
    case Consumable = 'Consumable';
    case Asset = 'Asset';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }
}
