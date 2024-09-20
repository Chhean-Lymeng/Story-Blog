<?php
use Illuminate\Support\Facades\Http;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Log;

if (!function_exists('sendNotificationToTopic')) {
    function sendNotificationToTopic($topic, $title, $body, $data = [])
    {
        $firebaseApiUrl = 'https://fcm.googleapis.com/v1/projects/nac-app-b7580/messages:send';
        $accessToken = getAccessToken();
        $payload = [
            'message' => [
                'topic' => $topic,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'apns' => array(
                    'payload' => array(
                        'aps' => array(
                            'sound' => 'default',
                            'apns-priority' => '10',
                            'content-available' => 1,
                            'mutable-content' => 1,
                        ),
                    ),
                ),
                'data' => (object) $data,
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post($firebaseApiUrl, $payload);

        if ($response->successful()) {
            return $response->json();
        } else {
            Log::error('FCM Error: ' . $response->body());
            Log::error('Payload: ' . json_encode($payload));
            return $response->body();
        }
    }
}

if (!function_exists('getAccessToken')) {
    function getAccessToken()
    {
        $serviceAccountPath = storage_path('app/nac-app-b7580-firebase-adminsdk-c1prs-d7510ecc25.json');
        
        $client = new GoogleClient();
        $client->setAuthConfig($serviceAccountPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->useApplicationDefaultCredentials();
        $accessTokenInfo = $client->fetchAccessTokenWithAssertion();
        return $accessTokenInfo['access_token'];
    }
}