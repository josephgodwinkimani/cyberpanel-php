<?php

declare(strict_types=1);

namespace Gkimani\CyberPanel;

use Gkimani\CyberPanel\Interfaces\FtpInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class Ftp implements FtpInterface
{
    const CREATE_FTP_ACCOUNT = 'submitFTPCreation';
    const FETCH_FTP_ACCOUNTS = 'getAllFTPAccounts';
    const DELETE_FTP_ACCOUNT = 'submitFTPDelete';

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
     * Create FTP Account
     *
     * @param string $serverUserName
     * @param string $ftpDomain
     * @param string $ftpUserName
     * @param string $passwordByPass
     * @param string $path
     * @return array
     */
    public function createFTPAccount(
        string $serverUserName,
        string $ftpDomain,
        string $ftpUserName,
        string $passwordByPass,
        string $path
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::CREATE_FTP_ACCOUNT,
                'ftpDomain' => $ftpDomain,
                'ftpUsername' => $ftpUserName,
                'passwordByPass' => $passwordByPass,
                'path' => $path
            ]
        );
    }

    /**
     * Fetch FTP Accounts
     *
     * @param string $serverUserName
     * @param string $selectedDomain
     * @return array
     */
    public function fetchFTPAccounts(
        string $serverUserName,
        string $selectedDomain
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::FETCH_FTP_ACCOUNTS,
                'selectedDomain' => $selectedDomain
            ]
        );
    }

    /**
     * Delete FTP Account
     *
     * @param string $serverUserName
     * @param string $ftpUsername
     * @return array
     */
    public function deleteFTPAccount(
        string $serverUserName,
        string $ftpUsername
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::DELETE_FTP_ACCOUNT,
                'ftpUsername' => $ftpUsername
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
