<?php

namespace App\Http\Controllers\Livestream;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LivestreamController extends Controller
{
    /**
     * Redirect to the livestream page for the current day of the week.
     */
    public function index(): RedirectResponse
    {
        return match (now()->dayOfWeek) {
            3 => redirect()->route('livestream.show', 'wednesday'),
            default => redirect()->route('livestream.show', 'sunday'),
        };
    }

    /**
     * Redirect to the liveestream page by the given day of the week.
     */
    public function show(string $day): RedirectResponse
    {
        return cache()->get("livestream.{$day}")
            ? redirect('https://youtu.be/'.cache()->get("livestream.{$day}"))
            : redirect('https://www.youtube.com/@SantaClausChristianChurch/streams');
    }
}
