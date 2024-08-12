<?php

declare(strict_types=1);

return [
    'appsId' => env('UNIFONIC_APP_SID', 'your-app-sid'),
    'senderId' => env('UNIFONIC_SENDER_ID', 'your-sender-id'),
    'endpoint' => env('UNIFONIC_ENDPOINT', 'https://el.cloud.unifonic.com/rest/SMS/messages'),
];
