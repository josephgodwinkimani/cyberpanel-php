<?php

namespace Gkimani\CyberPanel\Interfaces;

use Exception;
use RuntimeException;

interface ChildDomainInterface
{
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
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
    public function fetchChildDomains(
        string $serverUserName,
        string $masterDomain
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function deleteChildDomain(
        string $serverUserName,
        string $websiteName
    ): array;
}
