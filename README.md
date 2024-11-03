[![Github All Releases]([https://img.shields.io/github/downloads/atom/atom/total.svg](https://img.shields.io/packagist/dt/granada-pride/unifonic-sms
))]()
# Unifonic SMS for Laravel

**Unifonic SMS** is a Laravel package that provides seamless integration with
the [Unifonic SMS](https://www.unifonic.com/) service. It allows you to send SMS messages through the Unifonic platform
using Laravel's native notification system. Whether you need to send OTPs, alerts, or marketing messages, this package
simplifies the process by integrating directly into Laravel.

## Features

- **Seamless Integration:** Easily send SMS notifications through Unifonic.
- **Configurable:** Adjust settings via the Laravel config system.
- **Error Handling:** Full support for exception handling and logging.
- **Laravel Compatibility:** Compatible with Laravel 8.x, 9.x, and 10.x.
- **Secure:** Handles sensitive data securely.

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Advanced Usage](#advanced-usage)
- [Contributing](#contributing)
- [License](#license)

## Installation

To get started, install the package via Composer:

```bash
composer require granada-pride/unifonic-sms
```

### Requirements

- PHP >= 8.0
- Laravel >= 8.x

## Configuration

After installing the package, publish the configuration file:

```bash
php artisan vendor:publish --provider="GranadaPride\UnifonicSms\UnifonicSmsServiceProvider"
```

This will publish a unifonic.php configuration file to your config directory where you can set your AppSid, SenderID,
and Endpoint.

### Configuration Options

- **AppSid:** Your Unifonic application SID.
- **SenderID:** The name or number that will appear as the sender of the SMS.
- **Endpoint:** The Unifonic API endpoint (default: https://el.cloud.unifonic.com/rest/SMS/messages).

Example configuration (config/unifonic.php):

```php
return [
    'appsId' => env('UNIFONIC_APP_SID', 'your-app-sid'),
    'senderId' => env('UNIFONIC_SENDER_ID', 'your-sender-id'),
    'endpoint' => env('UNIFONIC_ENDPOINT', 'https://el.cloud.unifonic.com/rest/SMS/messages'),
];
```

To enable logging for the Unifonic SMS package, you can add a custom log channel in your config/logging.php file:

```php
'channels' => [
    // Other log channels...

    'unifonic' => [
        'driver' => 'single',
        'path' => storage_path('logs/unifonic.log'),
        'level' => 'error',
    ],
],
```

This configuration ensures that Unifonic SMS logs are stored in a separate log file at storage/logs/unifonic.log and
only logs messages with a severity level of error or higher.

## Usage

After configuring the package, you can send SMS notifications:

```php
use GranadaPride\UnifonicSms\Notifications\UnifonicSmsNotification;

$phone = '1234567890';
$message = "Your verification code is 123456";

$user->notify(new UnifonicSmsNotification($phone, $message));
```

## Advanced Usage

To customize the SMS further or handle different scenarios, you can modify the notification class:

```php
use GranadaPride\UnifonicSms\Notifications\UnifonicSmsNotification;

class CustomSmsNotification extends UnifonicSmsNotification
{
    public function toSms($notifiable)
    {
        return [
            'phone' => $this->phone,
            'message' => "Your custom message",
        ];
    }
}

// Sending the custom SMS
$user->notify(new CustomSmsNotification($phone, $message));
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request or open an issue to improve this package.

## License

This package is open-source software licensed under the MIT License. Please see the License File for more information.
