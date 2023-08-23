<?php

namespace App\Models\Concerns;

use App\Models\Redirect;
use Illuminate\Database\Eloquent\Model;

trait CreatesRedirects
{
    /**
     * Creates a redirect when the model's slug is changed.
     */
    public static function bootCreatesRedirects(): void
    {
        static::saved(function (Model $model) {
            if ($model->wasChanged('slug')) {
                Redirect::create([
                    'from' => $model->getOriginal('slug'),
                    'to' => $model->slug,
                ]);
            }
        });
    }
}
