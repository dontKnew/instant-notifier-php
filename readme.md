# Instant Notifier - Get Real Time, Leads & Notifications in Android Phone

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

**PHPMaster Instant Notifier** is a real-time notification library that allows you to send and receive updates about leads, messages, and other important events directly to your Android phone. It's designed for seamless API integration, ensuring that you stay informed in real-time.

## Features

- **Real-Time Notifications**: Send and receive instant updates about leads, messages, and more to your Android phone.
- **Custom API Integration**: Easily integrate with your APIs to trigger notifications.
- **Secure**: Data is securely encrypted to ensure your information remains private.
- **Quick and Easy Setup**: Set up the library and app quickly and start receiving notifications instantly.

## Installation

To install PHPMaster Instant Notifier via Composer:

```bash
composer require phpmaster/instantnotifier
```

```php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use PHPMaster\InstantNotifier\Notification;

require_once __DIR__ . '/vendor/autoload.php';
$package = (new Notification("<api_key>", "<client_id>"));
$message = $package->formMessage("There is new message, checkout ....", ['name'=>"Rahul Khanna", "site"=>"https://digitechsolution.in/package/", "Mobile"=>"9876543210", "email"=>"rahul@gmail.com"]);
$response = $package->send($message);
```

## For More Information Visit Site  
Site (https://instantnotifier.phpmaster.in/)