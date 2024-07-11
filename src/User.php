<?php

declare(strict_types=1);

namespace Gkimani\CyberPanel;

use Gkimani\CyberPanel\Interfaces\UserInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class User implements UserInterface
{
    const VERIFY_LOGIN = 'verifyLogin';
    const CREATE_USER = 'submitUserCreation';
    const FETCH_USERS = 'fetchUsers';
    const MODIFY_USER = 'saveModificationsUser';
    const CHANGE_USER_ACL = 'changeACLFunc';
    const DELETE_USER = 'submitUserDeletion';

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
                'Authorization' => 'Basic ' . base64_encode("{$username}:{$password}"),
            ],
        ]);
    }

    /**
     * Verify Login
     * @param string $serverUserName
     * @return array
     */
    public function verifyLogin(string $serverUserName): array
    {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::VERIFY_LOGIN,
            ]
        );
    }

    /**
     * Create User
     *
     * @param string $serverUserName
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $userName
     * @param string $password
     * @param int $websiteLimit
     * @param string $selectedACL
     * @return array
     */
    public function createUser(
        string $serverUserName,
        string $firstName,
        string $lastName,
        string $email,
        string $userName,
        string $password,
        int $websiteLimit,
        string $selectedACL
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::CREATE_USER,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'userName' => $userName,
                'password' => $password,
                'websitesLimit' => $websiteLimit,
                'selectedACL' => $selectedACL
            ]
        );
    }

    /**
     * Fetch Users
     *
     * @param string $serverUserName
     * @return array
     */
    public function fetchUsers(string $serverUserName): array
    {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::FETCH_USERS,
            ]
        );
    }

    /**
     * Modify User
     * @param string $serverUserName
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $userName
     * @param string $securityLevel
     * @param int $twofa
     * @param string $passwordByPass
     * @return array
     */
    public function modifyUser(
        string $serverUserName,
        string $firstName,
        string $lastName,
        string $email,
        string $userName,
        string $securityLevel,
        int $twofa,
        string $passwordByPass
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::MODIFY_USER,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'userName' => $userName,
                'securityLevel' => $securityLevel,
                'twofa' => $twofa,
                'passwordByPass' => $passwordByPass
            ]
        );
    }

    /**
     * Change User ACL
     *
     * @param string $serverUserName
     * @param string $selectedUser
     * @param string $selectedACL
     * @return array
     */
    public function changeUserACL(string $serverUserName, string $selectedUser, string $selectedACL): array
    {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::CHANGE_USER_ACL,
                'selectedUser' => $selectedUser,
                'selectedACL' => $selectedACL
            ]
        );
    }

    /**
     * Delete User
     *
     * @param string $serverUserName
     * @param string $accountUsername
     * @return array
     */
    public function deleteUser(string $serverUserName, string $accountUsername): array
    {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::DELETE_USER,
                'accountUsername' => $accountUsername
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
