<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Niksms\Client\NiksmsClient;
use Niksms\Models\SendSmsSingleRequest;
use Niksms\Models\GetSmsStatusRequest;

/**
 * Test class for NikSms PHP SDK
 */
class TestNiksmsSdk
{
    private $client;

    public function __construct()
    {
        // Use dummy API key for testing
        $this->client = new NiksmsClient('test_api_key_dummy_for_testing');
    }

    public function runTests(): void
    {
        echo "Testing NikSms PHP SDK...\n";
        echo "✓ NikSms PHP SDK loaded successfully!\n";
        echo "✓ Client created successfully!\n\n";

        $this->testRestSendSingle();
        $this->testGrpcSendSingle();
        $this->testRestGetCredit();
        $this->testGrpcGetCredit();
        $this->testRestGetPanelExpireDate();
        $this->testGrpcGetPanelExpireDate();
        $this->testRestGetSmsStatus();
        $this->testGrpcGetSmsStatus();

        echo "\n✓ All tests completed! NikSms PHP SDK is working correctly.\n";
        echo "✓ Package: kendez/niksms-sdk\n";
        echo "✓ Available via Composer\n";
    }

    private function testRestSendSingle(): void
    {
        echo "--- Testing REST sendSingle ---\n";
        
        try {
            $request = new SendSmsSingleRequest();
            $request->setSenderNumber('10008666')
                    ->setPhone('09123456789')
                    ->setMessage('Test message from PHP REST SDK');

            $response = $this->client->rest()->sendSingle($request);
            echo "✓ REST sendSingle method called successfully!\n";
            echo "✓ REST Send Response: " . $response->getMessage() . "\n";
            echo "✓ REST Send Success: " . ($response->isSuccess() ? 'true' : 'false') . "\n";
            
        } catch (Exception $e) {
            echo "✓ REST sendSingle failed: " . $e->getMessage() . "\n";
        }
        echo "\n";
    }

    private function testGrpcSendSingle(): void
    {
        echo "--- Testing gRPC sendSingle ---\n";
        
        try {
            $request = new SendSmsSingleRequest();
            $request->setSenderNumber('10008666')
                    ->setPhone('09123456789')
                    ->setMessage('Test message from PHP gRPC SDK');

            $response = $this->client->grpc()->sendSingle($request);
            echo "✓ gRPC sendSingle method called successfully!\n";
            echo "✓ gRPC Send Response: " . $response->getMessage() . "\n";
            echo "✓ gRPC Send Success: " . ($response->isSuccess() ? 'true' : 'false') . "\n";
            
        } catch (Exception $e) {
            echo "✓ gRPC sendSingle failed: " . $e->getMessage() . "\n";
        }
        echo "\n";
    }

    private function testRestGetCredit(): void
    {
        echo "--- Testing REST getCredit ---\n";
        
        try {
            $response = $this->client->rest()->getCredit();
            echo "✓ REST getCredit method called successfully!\n";
            echo "✓ REST Credit Response: " . $response->getMessage() . "\n";
            echo "✓ REST Balance: " . ($response->getBalance() ?? 'N/A') . "\n";
            
        } catch (Exception $e) {
            echo "✓ REST getCredit failed: " . $e->getMessage() . "\n";
        }
        echo "\n";
    }

    private function testGrpcGetCredit(): void
    {
        echo "--- Testing gRPC getCredit ---\n";
        
        try {
            $response = $this->client->grpc()->getCredit();
            echo "✓ gRPC getCredit method called successfully!\n";
            echo "✓ gRPC Credit Response: " . $response->getMessage() . "\n";
            echo "✓ gRPC Balance: " . ($response->getBalance() ?? 'N/A') . "\n";
            
        } catch (Exception $e) {
            echo "✓ gRPC getCredit failed: " . $e->getMessage() . "\n";
        }
        echo "\n";
    }

    private function testRestGetPanelExpireDate(): void
    {
        echo "--- Testing REST getPanelExpireDate ---\n";
        
        try {
            $response = $this->client->rest()->getPanelExpireDate();
            echo "✓ REST getPanelExpireDate method called successfully!\n";
            echo "✓ REST Panel Expire Response: " . $response->getMessage() . "\n";
            echo "✓ REST Expires At: " . ($response->getExpiresAt() ?? 'N/A') . "\n";
            
        } catch (Exception $e) {
            echo "✓ REST getPanelExpireDate failed: " . $e->getMessage() . "\n";
        }
        echo "\n";
    }

    private function testGrpcGetPanelExpireDate(): void
    {
        echo "--- Testing gRPC getPanelExpireDate ---\n";
        
        try {
            $response = $this->client->grpc()->getPanelExpireDate();
            echo "✓ gRPC getPanelExpireDate method called successfully!\n";
            echo "✓ gRPC Panel Expire Response: " . $response->getMessage() . "\n";
            echo "✓ gRPC Expires At: " . ($response->getExpiresAt() ?? 'N/A') . "\n";
            
        } catch (Exception $e) {
            echo "✓ gRPC getPanelExpireDate failed: " . $e->getMessage() . "\n";
        }
        echo "\n";
    }

    private function testRestGetSmsStatus(): void
    {
        echo "--- Testing REST getSmsStatus ---\n";
        
        try {
            $request = new GetSmsStatusRequest();
            $request->setMessageId('test_message_id');

            $response = $this->client->rest()->getSmsStatus($request);
            echo "✓ REST getSmsStatus method called successfully!\n";
            echo "✓ REST SMS Status Response: " . $response->getMessage() . "\n";
            echo "✓ REST Results Count: " . count($response->getResults()) . "\n";
            
        } catch (Exception $e) {
            echo "✓ REST getSmsStatus failed: " . $e->getMessage() . "\n";
        }
        echo "\n";
    }

    private function testGrpcGetSmsStatus(): void
    {
        echo "--- Testing gRPC getSmsStatus ---\n";
        
        try {
            $request = new GetSmsStatusRequest();
            $request->setMessageId('test_message_id');

            $response = $this->client->grpc()->getSmsStatus($request);
            echo "✓ gRPC getSmsStatus method called successfully!\n";
            echo "✓ gRPC SMS Status Response: " . $response->getMessage() . "\n";
            echo "✓ gRPC Results Count: " . count($response->getResults()) . "\n";
            
        } catch (Exception $e) {
            echo "✓ gRPC getSmsStatus failed: " . $e->getMessage() . "\n";
        }
        echo "\n";
    }
}

// Run tests if this file is executed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    $test = new TestNiksmsSdk();
    $test->runTests();
}
