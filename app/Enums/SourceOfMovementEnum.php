<?php

namespace App\Enums;

enum ItemTypeEnum: string
{
    case Invoice  = 'Invoice';
    case Issue    = 'Issue';
    case Return   = 'Return';
    case Scrap    = 'Scrap';
    case Refund   = 'Refund';
    case Reversal = 'Reversal';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }
}
