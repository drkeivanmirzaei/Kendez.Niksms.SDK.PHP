<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Niksms\Client\NiksmsClient;
use Niksms\Models\SendSmsSingleRequest;
use Niksms\Models\GetSmsStatusRequest;
use Niksms\Exceptions\AuthenticationException;
use Niksms\Exceptions\NetworkException;
use Niksms\Exceptions\ApiException;

/**
 * Basic usage example for NikSms PHP SDK
 */

// Initialize the client with your API key
$client = new NiksmsClient('your_api_key_here');

echo "=== NikSms PHP SDK Basic Usage Example ===\n\n";

// Example 1: Send single SMS via REST
echo "1. Sending SMS via REST API:\n";
try {
    $request = new SendSmsSingleRequest();
    $request->setSenderNumber('10008666')
            ->setPhone('09123456789')
            ->setMessage('Hello from NikSms PHP SDK! This is a test message.')
            ->setApiType(1); // Normal SMS

    $response = $client->rest()->sendSingle($request);
    
    if ($response->isSuccess()) {
        echo "✓ SMS sent successfully!\n";
        echo "  Message ID: " . $response->getMessageId() . "\n";
        echo "  Operation ID: " . $response->getOperationId() . "\n";
    } else {
        echo "✗ Failed to send SMS: " . $response->getMessage() . "\n";
    }
    
} catch (AuthenticationException $e) {
    echo "✗ Authentication failed: " . $e->getMessage() . "\n";
} catch (NetworkException $e) {
    echo "✗ Network error: " . $e->getMessage() . "\n";
} catch (ApiException $e) {
    echo "✗ API error: " . $e->getMessage() . "\n";
}

echo "\n";

// Example 2: Send single SMS via gRPC
echo "2. Sending SMS via gRPC API:\n";
try {
    $request = new SendSmsSingleRequest();
    $request->setSenderNumber('10008666')
            ->setPhone('09123456789')
            ->setMessage('Hello from NikSms PHP SDK via gRPC!')
            ->setApiType(2); // OTP SMS

    $response = $client->grpc()->sendSingle($request);
    
    if ($response->isSuccess()) {
        echo "✓ SMS sent successfully via gRPC!\n";
        echo "  Message ID: " . $response->getMessageId() . "\n";
    } else {
        echo "✗ Failed to send SMS via gRPC: " . $response->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "✗ gRPC error: " . $e->getMessage() . "\n";
}

echo "\n";

// Example 3: Get account credit
echo "3. Getting account credit:\n";
try {
    $response = $client->rest()->getCredit();
    
    if ($response->isSuccess()) {
        echo "✓ Credit retrieved successfully!\n";
        echo "  Balance: " . $response->getBalance() . "\n";
        echo "  Currency: " . $response->getCurrency() . "\n";
    } else {
        echo "✗ Failed to get credit: " . $response->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "✗ Credit error: " . $e->getMessage() . "\n";
}

echo "\n";

// Example 4: Get panel expiry date
echo "4. Getting panel expiry date:\n";
try {
    $response = $client->rest()->getPanelExpireDate();
    
    if ($response->isSuccess()) {
        echo "✓ Panel expiry date retrieved successfully!\n";
        echo "  Expires at: " . $response->getExpiresAt() . "\n";
    } else {
        echo "✗ Failed to get panel expiry date: " . $response->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "✗ Panel expiry error: " . $e->getMessage() . "\n";
}

echo "\n";

// Example 5: Get SMS status
echo "5. Getting SMS status:\n";
try {
    $request = new GetSmsStatusRequest();
    $request->setMessageId('your_message_id_here');

    $response = $client->rest()->getSmsStatus($request);
    
    if ($response->isSuccess()) {
        echo "✓ SMS status retrieved successfully!\n";
        echo "  Results count: " . count($response->getResults()) . "\n";
        
        foreach ($response->getResults() as $result) {
            echo "  Message ID: " . $result->getMessageId() . "\n";
            echo "  Status: " . $result->getStatus() . "\n";
            echo "  Description: " . $result->getDescription() . "\n";
        }
    } else {
        echo "✗ Failed to get SMS status: " . $response->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "✗ SMS status error: " . $e->getMessage() . "\n";
}

echo "\n=== Example completed ===\n";
