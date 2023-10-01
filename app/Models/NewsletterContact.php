<?php

namespace App\Models;

use App\Observers\NewsletterContactObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterContact extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::observe(NewsletterContactObserver::class);
    }
}
