# NikSms PHP SDK

A comprehensive PHP SDK for NikSms SMS service, supporting both REST and gRPC APIs.

## Features

- ✅ REST API client
- ✅ gRPC API client  
- ✅ All SMS operations (Single, Group, PTP, OTP)
- ✅ Credit and balance management
- ✅ SMS status tracking
- ✅ Panel expiry date checking
- ✅ Comprehensive error handling
- ✅ PSR-4 autoloading
- ✅ PHP 7.4+ support

## Installation

```bash
composer require kendez/niksms-sdk
```

## Quick Start

### REST Client

```php
<?php
require_once 'vendor/autoload.php';

use Niksms\Client\NiksmsClient;
use Niksms\Models\SendSmsSingleRequest;

$client = new NiksmsClient('your_api_key');

// Send single SMS
$request = new SendSmsSingleRequest();
$request->setSenderNumber('10008666')
        ->setPhone('09123456789')
        ->setMessage('Hello from NikSms PHP SDK!');

$response = $client->rest()->sendSingle($request);
echo "Message ID: " . $response->getMessageId() . "\n";
echo "Success: " . ($response->isSuccess() ? 'Yes' : 'No') . "\n";
```

### gRPC Client

```php
<?php
require_once 'vendor/autoload.php';

use Niksms\Client\NiksmsClient;
use Niksms\Models\SendSmsSingleRequest;

$client = new NiksmsClient('your_api_key');

// Send single SMS via gRPC
$request = new SendSmsSingleRequest();
$request->setSenderNumber('10008666')
        ->setPhone('09123456789')
        ->setMessage('Hello from NikSms PHP SDK via gRPC!');

$response = $client->grpc()->sendSingle($request);
echo "Message ID: " . $response->getMessageId() . "\n";
echo "Success: " . ($response->isSuccess() ? 'Yes' : 'No') . "\n";
```

## Available Methods

### SMS Operations
- `sendSingle()` - Send single SMS
- `sendGroup()` - Send SMS to multiple recipients
- `sendPtp()` - Send Point-to-Point SMS
- `sendOtp()` - Send OTP SMS

### Account Operations
- `getCredit()` - Get account credit
- `getPanelExpireDate()` - Get panel expiry date
- `getSmsStatus()` - Get SMS delivery status

## Configuration

```php
$client = new NiksmsClient('your_api_key', [
    'rest_base_url' => 'https://webservice.niksms.com/api/v1',
    'grpc_endpoint' => 'grpc.niksms.com:443',
    'timeout' => 30,
    'verify_ssl' => true
]);
```

## Error Handling

```php
try {
    $response = $client->rest()->sendSingle($request);
} catch (\Niksms\Exceptions\AuthenticationException $e) {
    echo "Authentication failed: " . $e->getMessage();
} catch (\Niksms\Exceptions\NetworkException $e) {
    echo "Network error: " . $e->getMessage();
} catch (\Niksms\Exceptions\ApiException $e) {
    echo "API error: " . $e->getMessage();
}
```

## Requirements

- PHP 7.4 or higher
- gRPC extension (for gRPC client)
- cURL extension (for REST client)

## License

MIT License - see LICENSE file for details.

## Support

For support and questions, please contact us at info@kendez.com
