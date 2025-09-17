<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FCMService {
    public static function sendNotification($token, $title, $body) {
        $SERVER_API_KEY = env('FIREBASE_SERVER_KEY');

        return Http::withHeaders([
            'Authorization' => 'key=' . $SERVER_API_KEY,
            'Content-Type'  => 'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            "to" => $token,
            "notification" => [
                "title" => $title,
                "body"  => $body,
            ]
        ])->json();
    }
}
