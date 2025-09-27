<?php

namespace Niksms\Client;

use Niksms\Client\Rest\NiksmsRestClient;
use Niksms\Client\Grpc\NiksmsGrpcClient;

/**
 * Main NikSms client class
 */
class NiksmsClient
{
    private $apiKey;
    private $config;
    private $restClient;
    private $grpcClient;

    public function __construct(string $apiKey, array $config = [])
    {
        $this->apiKey = $apiKey;
        $this->config = array_merge([
            'rest_base_url' => 'https://webservice.niksms.com/api/v1',
            'grpc_endpoint' => 'grpc.niksms.com:443',
            'timeout' => 30,
            'verify_ssl' => true,
            'user_agent' => 'Niksms-PHP-SDK/1.0.0'
        ], $config);
    }

    /**
     * Get REST client instance
     */
    public function rest(): NiksmsRestClient
    {
        if ($this->restClient === null) {
            $this->restClient = new NiksmsRestClient($this->apiKey, $this->config);
        }
        return $this->restClient;
    }

    /**
     * Get gRPC client instance
     */
    public function grpc(): NiksmsGrpcClient
    {
        if ($this->grpcClient === null) {
            $this->grpcClient = new NiksmsGrpcClient($this->apiKey, $this->config);
        }
        return $this->grpcClient;
    }

    /**
     * Get API key
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Get configuration
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Set configuration
     */
    public function setConfig(array $config): self
    {
        $this->config = array_merge($this->config, $config);
        
        // Reset clients to use new config
        $this->restClient = null;
        $this->grpcClient = null;
        
        return $this;
    }
}
