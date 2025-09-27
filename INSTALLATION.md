# NikSms PHP SDK - Installation Guide

## Prerequisites

Before installing the NikSms PHP SDK, ensure you have the following installed:

### 1. PHP 7.4 or Higher
- Download PHP from [php.net](https://www.php.net/downloads)
- Ensure PHP is added to your system PATH
- Required PHP extensions:
  - `curl` (for REST API)
  - `json` (for JSON handling)
  - `grpc` (for gRPC API - optional but recommended)

### 2. Composer
- Download Composer from [getcomposer.org](https://getcomposer.org/download/)
- Install Composer globally
- Verify installation: `composer --version`

### 3. Protocol Buffers (for gRPC)
- Install Protocol Buffers compiler (protoc)
- Download from [protobuf releases](https://github.com/protocolbuffers/protobuf/releases)
- Add protoc to your system PATH

## Installation Steps

### 1. Install Dependencies

```bash
composer install
```

### 2. Generate Protocol Buffer Files (for gRPC)

```bash
composer run generate-proto
```

### 3. Run Tests

```bash
composer test
```

### 4. Run Code Analysis

```bash
composer analyse
```

## Manual Installation (without Composer)

If you cannot use Composer, you can manually include the required dependencies:

### Required Libraries:
1. **Guzzle HTTP Client** - for REST API calls
2. **gRPC PHP Extension** - for gRPC API calls
3. **Protocol Buffers PHP** - for protobuf support

### Manual Setup:
1. Download and include Guzzle HTTP
2. Install gRPC PHP extension via PECL
3. Include the SDK files in your project
4. Generate protobuf files manually

## Configuration

### REST API Configuration
```php
$client = new NiksmsClient('your_api_key', [
    'rest_base_url' => 'https://webservice.niksms.com/api/v1',
    'timeout' => 30,
    'verify_ssl' => true
]);
```

### gRPC API Configuration
```php
$client = new NiksmsClient('your_api_key', [
    'grpc_endpoint' => 'grpc.niksms.com:443',
    'timeout' => 30,
    'verify_ssl' => true
]);
```

## Troubleshooting

### Common Issues:

1. **PHP not found**: Add PHP to your system PATH
2. **Composer not found**: Install Composer globally
3. **gRPC extension missing**: Install via PECL or compile from source
4. **Protocol buffer generation fails**: Ensure protoc is installed and in PATH

### Getting Help:
- Check PHP version: `php --version`
- Check Composer: `composer --version`
- Check protoc: `protoc --version`
- Check gRPC extension: `php -m | grep grpc`

## Development Setup

For development, you may also want to install:

```bash
composer install --dev
```

This will install PHPUnit for testing and PHPStan for static analysis.
