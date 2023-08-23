<?php

namespace App\Enums;

use Illuminate\Support\Carbon;

enum EventFrequency: string
{
    case WEEKLY = 'weekly';
    case BIWEEKLY = 'biweekly';
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case YEARLY = 'yearly';

    /**
     * All enum Event Frequency values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get the next occurrence of the event.
     */
    public function nextOccurance(Carbon $date): Carbon
    {
        return match ($this->value) {
            self::WEEKLY->value => $date->addWeek(),
            self::BIWEEKLY->value => $date->addWeeks(2),
            self::MONTHLY->value => $date->addMonth(),
            self::QUARTERLY->value => $date->addMonths(3),
            self::YEARLY->value => $date->addYear(),
        };
    }
}
