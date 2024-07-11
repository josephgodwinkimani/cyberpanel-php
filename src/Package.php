<?php

declare(strict_types=1);

namespace Gkimani\CyberPanel;

use Gkimani\CyberPanel\Interfaces\PackageInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class Package implements PackageInterface
{
    const CREATE_PACKAGE = 'submitPackage';
    const FETCH_PACKAGES = 'fetchPackages';
    const MODIFY_PACKAGE = 'submitPackageModify';
    const DELETE_PACKAGE = 'submitPackageDelete';

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
     * Create Package
     *
     * @param string $serverUserName
     * @param string $packageName
     * @param string $diskSpace
     * @param string $bandwidth
     * @param string $dataBases
     * @param string $ftpAccounts
     * @param string $emails
     * @param string $allowedDomains
     * @param string $api
     * @param string $allowFullDomain
     * @return array
     */
    public function createPackage(
        string $serverUserName,
        string $packageName,
        string $diskSpace,
        string $bandwidth,
        string $dataBases,
        string $ftpAccounts,
        string $emails,
        string $allowedDomains,
        string $api,
        string $allowFullDomain
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::CREATE_PACKAGE,
                'packageName' => $packageName,
                'diskSpace' => $diskSpace,
                'bandwidth' => $bandwidth,
                'dataBases' => $dataBases,
                'ftpAccounts' => $ftpAccounts,
                'emails' => $emails,
                'allowedDomains' => $allowedDomains,
                'api' => $api,
                'allowFullDomain' => $allowFullDomain
            ]
        );
    }

    /**
     * Fetch Packages
     *
     * @param string $serverUserName
     * @return array
     */
    public function fetchPackages(string $serverUserName): array
    {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::FETCH_PACKAGES,
            ]
        );
    }

    /**
     * Modify Package
     *
     * @param string $serverUserName
     * @param string $packageName
     * @param string $diskSpace
     * @param string $bandwidth
     * @param string $dataBases
     * @param string $ftpAccounts
     * @param string $emails
     * @param string $allowedDomains
     * @param string $api
     * @param string $allowFullDomain
     * @return array
     */
    public function modifyPackage(
        string $serverUserName,
        string $packageName,
        string $diskSpace,
        string $bandwidth,
        string $dataBases,
        string $ftpAccounts,
        string $emails,
        string $allowedDomains,
        string $api,
        string $allowFullDomain
    ): array {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::MODIFY_PACKAGE,
                'packageName' => $packageName,
                'diskSpace' => $diskSpace,
                'bandwidth' => $bandwidth,
                'dataBases' => $dataBases,
                'ftpAccounts' => $ftpAccounts,
                'emails' => $emails,
                'allowedDomains' => $allowedDomains,
                'api' => $api,
                'allowFullDomain' => $allowFullDomain
            ]
        );
    }

    /**
     * Delete Package
     *
     * @param string $serverUserName
     * @param string $packageName
     * @return array
     */
    public function deletePackage(string $serverUserName, string $packageName): array
    {
        return $this->sendRequest(
            'POST',
            '/cloudAPI/',
            [
                'serverUserName' => $serverUserName,
                'controller' => self::DELETE_PACKAGE,
                'packageName' => $packageName
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
