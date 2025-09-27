<?php

require_once "vendor/autoload.php";

use Niksms\Client\Rest\NiksmsRestClient;

echo "=== Testing NikSms PHP SDK ===" . PHP_EOL;

try {
    // Create REST client
    $client = new NiksmsRestClient("your-api-key-here");
    echo "âœ“ REST client created successfully" . PHP_EOL;

    // Test getCredit method
    echo "Testing getCredit method..." . PHP_EOL;
    $creditResponse = $client->getCredit();
    echo "âœ“ getCredit method executed" . PHP_EOL;
    echo "Response: " . $creditResponse->getMessage() . PHP_EOL;
    echo "Success: " . ($creditResponse->isSuccess() ? "true" : "false") . PHP_EOL;

    echo "=== SDK Test Completed Successfully ===" . PHP_EOL;

} catch (Exception $e) {
    echo "âœ— Error: " . $e->getMessage() . PHP_EOL;
    echo "File: " . $e->getFile() . PHP_EOL;
    echo "Line: " . $e->getLine() . PHP_EOL;
}
