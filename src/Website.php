<?php

declare(strict_types=1);

namespace Gkimani\CyberPanel;

use Gkimani\CyberPanel\Interfaces\WebsiteInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class Website implements WebsiteInterface
{
    const CREATE_WEBSITE = 'submitWebsiteCreation';
    const CHANGE_PHP = 'changePHP';
    const CHANGE_LINUX_USER_PASSWORD = 'ChangeLinuxUserPassword';
    const FETCH_WEBSITE = 'fetchWebsites';
    const DELETE_WEBSITE = 'submitWebsiteDeletion';

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
     *   Create Website
     *
     * @param string $serverUserName
     * @param string $domainName
     * @param string $package
     * @param string $adminEmail
     * @param string $phpSelection
     * @param string $websiteOwner
     * @param int $ssl
     * @param int $dkimCheck
     * @param int $openBasedir
     */
    public function createWebsite(
        string $serverUserName,
        string $domainName,
        string $package,
        string $adminEmail,
        string $phpSelection,
        string $websiteOwner,
        int $ssl,
        int $dkimCheck,
        int $openBasedir
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::CREATE_WEBSITE,
                'domainName' => $domainName,
                'package' => $package,
                'adminEmail' => $adminEmail,
                'phpSelection' => $phpSelection,
                'websiteOwner' => $websiteOwner,
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
     *   Change Website Linux User Password
     *
     * @param string $serverUserName
     * @param string $domain
     * @param string $password
     */
    public function changeWebsiteLinuxUserPassword(
        string $serverUserName,
        string $domain,
        string $password
    ): array {
        return $this->sendRequest('POST', '/cloudAPI/', [
            'serverUserName' => $serverUserName,
            'controller' => self::CHANGE_LINUX_USER_PASSWORD,
            'domain' => $domain,
            'password' => $password
        ]);
    }

    /**
     *   Fetch Websites
     *
     * @param string $serverUserName
     * @param string $websiteName
     * @param int $page
     */
    public function fetchWebsites(
        string $serverUserName,
        string $websiteName,
        int $page
    ): array {
        return $this->sendRequest('POST', '/cloudAPI/', [
            'serverUserName' => $serverUserName,
            'controller' => self::FETCH_WEBSITE,
            'websiteName' => $websiteName,
            'page' => $page
        ]);
    }

    /**
     *   Delete Website
     *
     * @param string $serverUserName
     * @param string $websiteName
     */
    public function deleteWebsite(
        string $serverUserName,
        string $websiteName
    ): array {
        return $this->sendRequest('POST', '/cloudAPI/', [
            'serverUserName' => $serverUserName,
            'controller' => self::DELETE_WEBSITE,
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
