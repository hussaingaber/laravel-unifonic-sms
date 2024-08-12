<?php

declare(strict_types=1);

namespace GranadaPride\UnifonicSms\Channels;

use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UnifonicSmsChannel
{
    public function send($notifiable, Notification $notification): void
    {
        $data = $notification->toSms($notifiable);

        try {
            $response = Http::withHeaders([
                'accept' => 'application/json',
            ])
                ->asForm()
                ->post(config('unifonic.endpoint'), [
                    'AppSid' => config('unifonic.appsId'),
                    'Recipient' => $data['phone'],
                    'Body' => $data['message'],
                    'SenderID' => config('unifonic.senderId'),
                ]);

            if ($response->failed()) {
                Log::channel('unifonic')->error('Failed to send SMS via Unifonic', [
                    'phone' => $data['phone'],
                    'message' => $data['message'],
                    'response' => $response->body(),
                ]);
            }

        } catch (Exception $e) {
            Log::channel('unifonic')->error('Exception occurred while sending SMS via Unifonic', [
                'phone' => $data['phone'],
                'message' => $data['message'],
                'error' => $e->getMessage(),
            ]);
        }
    }
}
