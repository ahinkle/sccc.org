<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TracksUserUpdates
{
    /**
     * Updates the user who last updated the model.
     */
    public static function bootTracksUserUpdates(): void
    {
        static::saved(function (Model $model) {
            $model->last_updated_id = auth()->id() ?? $model->last_updated_id;
        });
    }

    /**
     * The last user to update the model.
     */
    public function lastUpdatedBy(): BelongsTo
    {
        return self::belongsTo(User::class, 'updated_by_id');
    }
}
