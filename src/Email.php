<?php

declare(strict_types=1);

namespace Gkimani\CyberPanel;

use Gkimani\CyberPanel\Interfaces\EmailInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class Email implements EmailInterface
{
    const CREATE_EMAIL_ACCOUNT = 'submitEmailCreation';
    const FETCH_EMAIL_ACCOUNTS = 'getEmailsForDomain';
    const DELETE_EMAIL_ACCOUNT = 'submitEmailDeletion';

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
     * Create Email Account
     *
     * @param string $serverUserName
     * @param string $domain
     * @param string $username
     * @param string $passwordByPass
     * @return array
     */
    public function createEmailAccount(
        string $serverUserName,
        string $domain,
        string $username,
        string $passwordByPass
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::CREATE_EMAIL_ACCOUNT,
                'domain' => $domain,
                'username' => $username,
                'passwordByPass' => $passwordByPass
            ]
        );
    }

    /**
     * Fetch Email Accounts
     *
     * @param string $serverUserName
     * @param string $domain
     * @return array
     */
    public function fetchEmailAccounts(
        string $serverUserName,
        string $domain
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::FETCH_EMAIL_ACCOUNTS,
                'domain' => $domain
            ]
        );
    }

    /**
     * Delete Email Account
     *
     * @param string $serverUserName
     * @param string $email
     * @return array
     */
    public function deleteEmailAccount(
        string $serverUserName,
        string $email
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::DELETE_EMAIL_ACCOUNT,
                'email' => $email
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
