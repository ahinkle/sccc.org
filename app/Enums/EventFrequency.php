<?php

namespace App\Enums;

enum EventFrequency: string
{
    case weekly = 'weekly';
    case biweekly = 'biweekly';
    case monthly = 'monthly';
    case quarterly = 'quarterly';
    case yearly = 'yearly';

    /**
     * All enum Event Frequency values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
