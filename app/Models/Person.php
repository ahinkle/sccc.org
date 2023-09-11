<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * Interact with the staff image attribute.
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ?: 'https://via.placeholder.com/640x480?text=Coming+Soon',
        );
    }

    /**
     * Scope a query to only include staff members.
     */
    public function scopeStaff(Builder $query): Builder
    {
        return $query->where('is_staff', true);
    }
}
