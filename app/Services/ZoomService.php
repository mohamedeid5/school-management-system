<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ZoomService
{
    public function getToken()
    {
        return Cache::remember('zoom_access_token', now()->addMinutes(50), function() {
            $response = Http::asForm()->withBasicAuth(
                config('services.zoom.client_id'),
                config('services.zoom.client_secret')
            )->post('https://zoom.us/oauth/token', [
                'grant_type' => 'account_credentials',
                'account_id' => config('services.zoom.account_id')
            ]);

            return $response->json()['access_token'];
        });
    }

    public function createMeeting($data)
    {
        $token = $this->getToken();

        $response = Http::withToken($token)->post('https://api.zoom.us/v2/users/me/meetings', [
            'topic'      => $data['topic'],
            'type'       => 2,
            'start_time' => $data['start_at'],
            'duration'   => $data['duration'],
            'timezone'   => config('app.timezone'),
            'settings'   => [
                'host_video'        => true,
                'participant_video' => true,
                'waiting_room'      => true,
            ],
        ]);

        return $response->json();
    }
}
