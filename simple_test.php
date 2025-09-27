<?php

/**
 * Simple test for NikSms PHP SDK without external dependencies
 * This test validates the basic structure and class loading
 */

echo "=== NikSms PHP SDK Structure Test ===\n\n";

// Test 1: Check if all required files exist
$requiredFiles = [
    'src/Niksms/Client/NiksmsClient.php',
    'src/Niksms/Client/Rest/NiksmsRestClient.php',
    'src/Niksms/Client/Grpc/NiksmsGrpcClient.php',
    'src/Niksms/Models/BaseModel.php',
    'src/Niksms/Models/BaseResponse.php',
    'src/Niksms/Models/SendSmsSingleRequest.php',
    'src/Niksms/Models/SendSmsSingleResponse.php',
    'src/Niksms/Models/GetCreditResponse.php',
    'src/Niksms/Models/GetPanelExpireDateResponse.php',
    'src/Niksms/Models/GetSmsStatusRequest.php',
    'src/Niksms/Models/GetSmsStatusResponse.php',
    'src/Niksms/Exceptions/NiksmsException.php',
    'src/Niksms/Exceptions/AuthenticationException.php',
    'src/Niksms/Exceptions/NetworkException.php',
    'src/Niksms/Exceptions/ApiException.php',
    'src/Niksms/Exceptions/ValidationException.php',
    'composer.json',
    'README.md',
    'LICENSE'
];

echo "1. Checking required files:\n";
$allFilesExist = true;
foreach ($requiredFiles as $file) {
    if (file_exists($file)) {
        echo "✓ $file\n";
    } else {
        echo "✗ $file (missing)\n";
        $allFilesExist = false;
    }
}

if ($allFilesExist) {
    echo "✓ All required files exist!\n";
} else {
    echo "✗ Some files are missing!\n";
}

echo "\n";

// Test 2: Check directory structure
echo "2. Checking directory structure:\n";
$requiredDirs = [
    'src/Niksms',
    'src/Niksms/Client',
    'src/Niksms/Client/Rest',
    'src/Niksms/Client/Grpc',
    'src/Niksms/Models',
    'src/Niksms/Exceptions',
    'tests',
    'examples',
    'proto'
];

$allDirsExist = true;
foreach ($requiredDirs as $dir) {
    if (is_dir($dir)) {
        echo "✓ $dir/\n";
    } else {
        echo "✗ $dir/ (missing)\n";
        $allDirsExist = false;
    }
}

if ($allDirsExist) {
    echo "✓ All required directories exist!\n";
} else {
    echo "✗ Some directories are missing!\n";
}

echo "\n";

// Test 3: Check composer.json structure
echo "3. Checking composer.json structure:\n";
if (file_exists('composer.json')) {
    $composerJson = json_decode(file_get_contents('composer.json'), true);
    
    $requiredKeys = ['name', 'description', 'type', 'license', 'require', 'autoload'];
    $allKeysExist = true;
    
    foreach ($requiredKeys as $key) {
        if (isset($composerJson[$key])) {
            echo "✓ $key\n";
        } else {
            echo "✗ $key (missing)\n";
            $allKeysExist = false;
        }
    }
    
    if ($allKeysExist) {
        echo "✓ composer.json structure is correct!\n";
    } else {
        echo "✗ composer.json structure has issues!\n";
    }
} else {
    echo "✗ composer.json not found!\n";
}

echo "\n";

// Test 4: Check README.md
echo "4. Checking README.md:\n";
if (file_exists('README.md')) {
    $readme = file_get_contents('README.md');
    $requiredSections = ['Installation', 'Quick Start', 'REST Client', 'gRPC Client'];
    
    $allSectionsExist = true;
    foreach ($requiredSections as $section) {
        if (strpos($readme, $section) !== false) {
            echo "✓ $section section\n";
        } else {
            echo "✗ $section section (missing)\n";
            $allSectionsExist = false;
        }
    }
    
    if ($allSectionsExist) {
        echo "✓ README.md has all required sections!\n";
    } else {
        echo "✗ README.md is missing some sections!\n";
    }
} else {
    echo "✗ README.md not found!\n";
}

echo "\n";

// Test 5: Check proto file
echo "5. Checking Protocol Buffer file:\n";
if (file_exists('proto/Service.proto')) {
    echo "✓ Service.proto exists\n";
    $protoContent = file_get_contents('proto/Service.proto');
    if (strpos($protoContent, 'service GrpcWebService') !== false) {
        echo "✓ Service.proto contains gRPC service definition\n";
    } else {
        echo "✗ Service.proto missing gRPC service definition\n";
    }
} else {
    echo "✗ Service.proto not found!\n";
}

echo "\n";

// Summary
echo "=== Summary ===\n";
if ($allFilesExist && $allDirsExist) {
    echo "✓ NikSms PHP SDK structure is complete!\n";
    echo "✓ Ready for Composer installation and testing\n";
    echo "\nNext steps:\n";
    echo "1. Install PHP and Composer\n";
    echo "2. Run: composer install\n";
    echo "3. Generate protobuf files: composer run generate-proto\n";
    echo "4. Run tests: composer test\n";
} else {
    echo "✗ NikSms PHP SDK structure has issues!\n";
    echo "Please check the missing files/directories above.\n";
}

echo "\n=== Test completed ===\n";
