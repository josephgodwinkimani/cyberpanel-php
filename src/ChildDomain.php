<?php

declare(strict_types=1);

namespace Gkimani\CyberPanel;

use Gkimani\CyberPanel\Interfaces\ChildDomainInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class ChildDomain implements ChildDomainInterface
{
    const CREATE_CHILD_DOMAIN = 'submitDomainCreation';
    const CHANGE_PHP = 'changePHP';
    const FETCH_CHILD_DOMAIN = 'fetchDomains';
    const DELETE_CHILD_DOMAIN = 'submitDomainDeletion';

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
     * Create Child Domain
     *
     * @param string $serverUserName
     * @param string $masterDomain
     * @param string $domainName
     * @param string $package
     * @param string $adminEmail
     * @param string $phpSelection
     * @param string $websiteOwner
     * @param string $path
     * @param string $ssl
     * @param string $dkimCheck
     * @param string $openBasedir
     * @return array
     */
    public function createChildDomain(
        string $serverUserName,
        string $masterDomain,
        string $domainName,
        string $package,
        string $adminEmail,
        string $phpSelection,
        string $websiteOwner,
        string $path,
        string $ssl,
        string $dkimCheck,
        string $openBasedir
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::CREATE_CHILD_DOMAIN,
                'domainName' => $domainName,
                'masterDomain' => $masterDomain,
                'package' => $package,
                'adminEmail' => $adminEmail,
                'phpSelection' => $phpSelection,
                'websiteOwner' => $websiteOwner,
                'path' => $path,
                'ssl' => $ssl,
                'dkimCheck' => $dkimCheck,
                'openBasedir' => $openBasedir
            ]
        );
    }

    /**
     *   Change Website PHP Version
     *
     * @param string $serverUserName
     * @param string $childDomain
     * @param string $phpSelection
     */
    public function changeWebsitePHPVersion(
        string $serverUserName,
        string $childDomain,
        string $phpSelection
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::CHANGE_PHP,
                'childDomain' => $childDomain,
                'phpSelection' => $phpSelection
            ]
        );
    }

    /**
     *   Fetch Child Domains
     *
     * @param string $serverUserName
     * @param string $masterDomain
     */
    public function fetchChildDomains(
        string $serverUserName,
        string $masterDomain
    ): array {
        return $this->sendRequest('POST', '/cloudAPI/', [
            'serverUserName' => $serverUserName,
            'controller' => self::FETCH_CHILD_DOMAIN,
            'masterDomain' => $masterDomain
        ]);
    }

    /**
     *   Delete Child Domain
     *
     * @param string $serverUserName
     * @param string $websiteName
     */
    public function deleteChildDomain(string $serverUserName, string $websiteName): array
    {
        return $this->sendRequest('POST', '/cloudAPI/', [
            'serverUserName' => $serverUserName,
            'controller' => self::DELETE_CHILD_DOMAIN,
            'websiteName' => $websiteName
        ]);
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
