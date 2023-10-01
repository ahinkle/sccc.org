<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;

class LatestMessageController extends Controller
{
    /**
     * Redirect to the latest message YouTube video.
     */
    public function redirect(): RedirectResponse
    {
        $latestMessage = Message::orderBy('message_date', 'desc')->first();

        return redirect($latestMessage?->youtube_url ?? route('messages'));
    }
}
