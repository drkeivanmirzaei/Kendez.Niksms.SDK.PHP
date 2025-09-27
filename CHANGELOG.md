# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2024-01-XX

### Added
- Initial release of NikSms PHP SDK
- REST API client implementation
- gRPC API client (placeholder implementation)
- Support for all SMS operations:
  - Single SMS sending
  - Group SMS sending
  - Point-to-Point (PTP) SMS sending
  - OTP SMS sending
- Account management features:
  - Credit balance checking
  - Panel expiry date checking
  - SMS status tracking
- Comprehensive error handling with custom exceptions
- PSR-4 autoloading support
- PHP 7.4+ compatibility
- MIT license

### Features
- Automatic ApiKey and ServiceType injection
- Support for both REST and gRPC protocols
- Extensive documentation and examples
- Unit tests with PHPUnit
- Static analysis with PHPStan
- Composer package management

### Dependencies
- PHP >= 7.4
- Guzzle HTTP client for REST API
- gRPC extension for gRPC support
- Google Protocol Buffers
