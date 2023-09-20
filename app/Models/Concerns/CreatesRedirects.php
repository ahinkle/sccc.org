<?php

namespace App\Models\Concerns;

use App\Models\Redirect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
                    'from' => self::guessRedirectDirectory($model).'/'.$model->getOriginal('slug'),
                    'to' => self::guessRedirectDirectory($model).'/'.$model->slug,
                ]);
            }
        });
    }

    /**
     * Guess the redirect categorial directory from the model's class name.
     */
    protected static function guessRedirectDirectory(Model $model): string
    {
        return Str::plural(strtolower(class_basename($model)));
    }
}
