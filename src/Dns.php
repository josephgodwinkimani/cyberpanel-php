<?php

declare(strict_types=1);

namespace Gkimani\CyberPanel;

use Gkimani\CyberPanel\Interfaces\DnsInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class Dns implements DnsInterface
{
    const ADD_DNS_RECORD = 'addDNSRecord';
    const FETCH_DNS_RECORDS = 'getCurrentRecordsForDomain';
    const DELETE_DNS_RECORD = 'deleteDNSRecord';

    private GuzzleClient $client;
    private string $baseUrl;
    private string $username;
    private string $password;

    public function __construct(string $baseUrl, string $username, string $password, float $timeout = 2.0)
    {
        $this->baseUrl = $baseUrl;
        $this->username = $username;
        $this->password = $password;
        $this->client = new GuzzleClient([
            'base_uri' => $this->baseUrl,
            // 'auth' => [$username, $password],
            'timeout' => $timeout,
            'headers' => [
                'Content-Type' => 'application/json',
                'cache-control' => 'no-cache',
                'Authorization' => 'Basic ' . base64_encode('{$username}:{$password}'),
            ],
        ]);
    }

    /**
     * Create DNS Record
     *
     * @param string $serverUserName
     * @param string $selectedZone
     * @param string $recordName
     * @param string $recordContentA
     * @param int $ttl
     * @param string $recordType
     * @return array
     */
    public function createDNSRecord(
        string $serverUserName,
        string $selectedZone,
        string $recordName,
        string $recordContentA,
        int $ttl,
        string $recordType
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::ADD_DNS_RECORD,
                'selectedZone' => $selectedZone,
                'recordName' => $recordName,
                'recordContentA' => $recordContentA,
                'ttl' => $ttl,
                'recordType' => $recordType
            ]
        );
    }

    /**
     * Fetch DNS Records of domain name
     *
     * @param string $serverUserName
     * @return array
     */
    public function fetchDNSRecords(
        string $serverUserName,
        string $selectedZone,
        string $currentSelection
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::FETCH_DNS_RECORDS,
                'selectedZone' => $selectedZone,
                'currentSelection' => $currentSelection
            ]
        );
    }

    /**
     * Delete DNS Record
     *
     * @param string $serverUserName
     * @param string $id
     * @return array
     */
    public function deleteDNSRecord(string $serverUserName, string $id): array
    {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::DELETE_DNS_RECORD,
                'id' => $id
            ]
        );
    }

    private function sendRequest(string $method, string $endpoint, array $data = []): array
    {
        try {
            $response = $this->client->request($method, $endpoint, [
                'json' => $data,
                'auth' => [$this->username, $this->password],
            ]);
            $responseBody = $response->getBody();
            $contents = $responseBody->getContents();
            $responseData = (array) json_decode($contents, true);
            return $responseData;
        } catch (GuzzleException $e) {
            return [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
    }
}
