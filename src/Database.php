<?php

declare(strict_types=1);

namespace Gkimani\CyberPanel;

use Gkimani\CyberPanel\Interfaces\DatabaseInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class Database implements DatabaseInterface
{
    const CREATE_DATABASE = 'submitDBCreation';
    const FETCH_DATABASES = 'fetchDatabases';
    const DELETE_DATABASE = 'submitDatabaseDeletion';

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
     * Create Database
     *
     * @param string $serverUserName
     * @param string $databaseWebsite
     * @param string $dbName
     * @param string $dbUsername
     * @param int $dbPassword
     * @param string $webUserName
     * @return array
     */
    public function createDatabase(
        string $serverUserName,
        string $databaseWebsite,
        string $dbName,
        string $dbUsername,
        int $dbPassword,
        string $webUserName
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::CREATE_DATABASE,
                'dbName' => $dbName,
                'dbUsername' => $dbUsername,
                'dbPassword' => $dbPassword,
                'webUserName' => $webUserName
            ]
        );
    }

    /**
     * Fetch Databases
     *
     * @param string $serverUserName
     * @param string $databaseWebsite
     * @return array
     */
    public function fetchDatabases(
        string $serverUserName,
        string $databaseWebsite
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::FETCH_DATABASES,
                'databaseWebsite' => $databaseWebsite,
            ]
        );
    }

    /**
     * Delete Database
     *
     * @param string $serverUserName
     * @param string $dbName
     * @return array
     */
    public function deleteDatabase(
        string $serverUserName,
        string $dbName
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::DELETE_DATABASE,
                'dbName' => $dbName
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
