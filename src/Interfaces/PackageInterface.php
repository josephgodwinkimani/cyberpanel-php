<?php

namespace Gkimani\CyberPanel\Interfaces;

use Exception;
use RuntimeException;

interface PackageInterface
{
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
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
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function fetchPackages(string $serverUserName): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
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
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function deletePackage(
        string $serverUserName,
        string $packageName
    ): array;
}
