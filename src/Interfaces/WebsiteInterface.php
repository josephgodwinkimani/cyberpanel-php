<?php

namespace Gkimani\CyberPanel\Interfaces;

use Exception;
use RuntimeException;

interface WebsiteInterface
{
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
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
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function changeWebsitePHPVersion(
        string $serverUserName,
        string $childDomain,
        string $phpSelection
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function changeWebsiteLinuxUserPassword(
        string $serverUserName,
        string $domain,
        string $password
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function fetchWebsites(
        string $serverUserName,
        string $websiteName,
        int $page
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function deleteWebsite(string $serverUserName, string $websiteName): array;
}
