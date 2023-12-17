<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index(): Factory|View
    {
        return view('pages.events');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event): Factory|View
    {
        return view('pages.events.event', compact('event'));
    }
}
