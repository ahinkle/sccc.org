<?php

namespace App\Support\Elexio;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Elexio
{
    /**
     * The base URL for the Elexio API.
     */
    public string $baseUrl = 'https://santaclauscc.elexiochms.com:443/api/';

    /**
     * Get events from Elexio.
     */
    public function events(Carbon $start, Carbon $end): array
    {
        $response = Http::get($this->baseUrl.'calendar/events', [
            'session_id' => $this->session(),
            'start' => $start->toIso8601String(),
            'end' => $end->toIso8601String(),
            'view' => config('elexio.events.view'),
        ]);

        if ($response->failed()) {
            throw new Exception('Elexio events request failed.'.PHP_EOL.$response->body());
        }

        return $response->json()['data'];
    }

    /**
     * Get the specified event from Elexio.
     */
    public function event(string $id): Response
    {
        return Http::get($this->baseUrl.'calendar/event/'.$id, [
            'session_id' => $this->session(),
        ]);
    }

    /**
     * Attempt to authenticate with Elexio and return the token.
     */
    public function login(string $username, string $password): string
    {
        $response = Http::post($this->baseUrl.'user/login', [
            'username' => $username,
            'password' => $password,
        ]);

        if ($response->failed()) {
            throw new Exception('Elexio authentication failed.'.PHP_EOL.$response->body());
        }

        return $response->json()['data']['session_id'];
    }

    /**
     * Get the Elexio session ID.
     */
    protected function session(): string
    {
        return Cache::remember('elexio_session_id', 60 * 10,
            fn () => $this->login(
                config('elexio.username'),
                config('elexio.password'),
            )
        );
    }
}
