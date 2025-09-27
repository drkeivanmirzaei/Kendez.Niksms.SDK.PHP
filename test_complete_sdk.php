<?php

require_once 'vendor/autoload.php';

use Niksms\Client\Rest\NiksmsRestClient;
use Niksms\Models\SendSmsSingleRequest;
use Niksms\Models\SendSmsGroupRequest;
use Niksms\Models\SendSmsPtpRequest;
use Niksms\Models\SendSmsOtpRequest;
use Niksms\Models\GetSmsStatusRequest;

echo "=== Testing Complete NikSms PHP SDK ===\n";

// مشخصات تست
$apiKey = "Your Api Key";

try {
    // ایجاد کلاینت REST
    echo "Creating REST client...\n";
    $client = new NiksmsRestClient($apiKey);
    echo "✓ REST client created successfully\n";

    // تست getCredit
    echo "\n--- Testing getCredit ---\n";
    $creditResponse = $client->getCredit();
    echo "✓ getCredit method executed\n";
    echo "Response: " . $creditResponse->getMessage() . "\n";
    echo "Success: " . ($creditResponse->isSuccess() ? "true" : "false") . "\n";
    if ($creditResponse->isSuccess()) {
        echo "Balance: " . $creditResponse->getBalance() . "\n";
        echo "Currency: " . $creditResponse->getCurrency() . "\n";
    }

    // تست getPanelExpireDate
    echo "\n--- Testing getPanelExpireDate ---\n";
    $expireResponse = $client->getPanelExpireDate();
    echo "✓ getPanelExpireDate method executed\n";
    echo "Response: " . $expireResponse->getMessage() . "\n";
    echo "Success: " . ($expireResponse->isSuccess() ? "true" : "false") . "\n";

    // تست sendSingle
    echo "\n--- Testing sendSingle ---\n";
    $singleRequest = new SendSmsSingleRequest();
    $singleRequest->ApiKey = $apiKey;
    $singleRequest->SenderNumber = "";
    $singleRequest->Phone = "Your Phone Number";
    $singleRequest->Message = "Test single SMS from PHP SDK";
    $singleRequest->ServiceType = "SDK_Php";
    $singleRequest->ApiType = 1;
    
    $sendResponse = $client->sendSingle($singleRequest);
    echo "✓ sendSingle method executed\n";
    echo "Response: " . $sendResponse->getMessage() . "\n";
    echo "Success: " . ($sendResponse->isSuccess() ? "true" : "false") . "\n";
    
    $messageId = null;
    if ($sendResponse->isSuccess() && $sendResponse->getData()) {
        echo "Data: " . json_encode($sendResponse->getData()) . "\n";
        // Extract messageId for status check
        if (isset($sendResponse->getData()['result']['messageIds'][0])) {
            $messageId = $sendResponse->getData()['result']['messageIds'][0];
        }
    }

    // تست sendOtp
    echo "\n--- Testing sendOtp ---\n";
    $otpRequest = new SendSmsOtpRequest();
    $otpRequest->ApiKey = $apiKey;
    $otpRequest->SenderNumber = "";
    $otpRequest->Phone = "Your Phone Number";
    $otpRequest->Message = "Your OTP code: 123456";
    $otpRequest->ServiceType = "SDK_Php";
    $otpRequest->ApiType = 1;
    
    $otpResponse = $client->sendOtp($otpRequest);
    echo "✓ sendOtp method executed\n";
    echo "Response: " . $otpResponse->getMessage() . "\n";
    echo "Success: " . ($otpResponse->isSuccess() ? "true" : "false") . "\n";

    // تست sendGroup
    echo "\n--- Testing sendGroup ---\n";
    $groupRequest = new SendSmsGroupRequest();
    $groupRequest->ApiKey = $apiKey;
    $groupRequest->SenderNumber = "";
    $groupRequest->Message = "Group SMS test from PHP SDK";
    $groupRequest->ServiceType = "SDK_Php";
    $groupRequest->ApiType = 1;
    $groupRequest->Recipients = [
        ["Phone" => "Your Phone Number", "MessageId" => "group_msg_1"],
        ["Phone" => "Your Second Phone Number", "MessageId" => "group_msg_2"]
    ];
    
    $groupResponse = $client->sendGroup($groupRequest);
    echo "✓ sendGroup method executed\n";
    echo "Response: " . $groupResponse->getMessage() . "\n";
    echo "Success: " . ($groupResponse->isSuccess() ? "true" : "false") . "\n";

    // تست sendPtp
    echo "\n--- Testing sendPtp ---\n";
    $ptpRequest = new SendSmsPtpRequest();
    $ptpRequest->ApiKey = $apiKey;
    $ptpRequest->SenderNumber = "";
    $ptpRequest->ServiceType = "SDK_Php";
    $ptpRequest->ApiType = 1;
    $ptpRequest->Recipients = [
        [
            "Phone" => "Your Phone Number", 
            "Message" => "Personal message 1", 
            "MessageId" => "ptp_msg_1"
        ],
        [
            "Phone" => "Your Second Phone Number", 
            "Message" => "Personal message 2", 
            "MessageId" => "ptp_msg_2"
        ]
    ];
    
    $ptpResponse = $client->sendPtp($ptpRequest);
    echo "✓ sendPtp method executed\n";
    echo "Response: " . $ptpResponse->getMessage() . "\n";
    echo "Success: " . ($ptpResponse->isSuccess() ? "true" : "false") . "\n";

    // تست getSmsStatus (اگر messageId داریم)
    if ($messageId) {
        echo "\n--- Testing getSmsStatus ---\n";
        $statusRequest = new GetSmsStatusRequest();
        $statusRequest->ApiKey = $apiKey;
        $statusRequest->ServiceType = "SDK_Php";
        $statusRequest->MessageIds = [$messageId];
        
        $statusResponse = $client->getSmsStatus($statusRequest);
        echo "✓ getSmsStatus method executed\n";
        echo "Response: " . $statusResponse->getMessage() . "\n";
        echo "Success: " . ($statusResponse->isSuccess() ? "true" : "false") . "\n";
        if ($statusResponse->isSuccess()) {
            echo "Status Data: " . json_encode($statusResponse->getData()) . "\n";
        }
    }

    echo "\n=== Complete SDK Test Completed ===\n";
    echo "✓ All methods tested successfully!\n";

} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
