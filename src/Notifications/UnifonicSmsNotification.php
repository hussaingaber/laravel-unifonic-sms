<?php

declare(strict_types=1);

namespace GranadaPride\UnifonicSms\Notifications;

use GranadaPride\UnifonicSms\Channels\UnifonicSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UnifonicSmsNotification extends Notification
{
    use Queueable;

    public function __construct(protected string $phone, protected string $message) {}

    public function via($notifiable): array
    {
        return [UnifonicSmsChannel::class];
    }

    public function toSms($notifiable): array
    {
        return [
            'phone' => $this->phone,
            'message' => $this->message,
        ];
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
