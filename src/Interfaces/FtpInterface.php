<?php

namespace Gkimani\CyberPanel\Interfaces;

use Exception;
use RuntimeException;

interface FtpInterface
{
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function createFTPAccount(
        string $serverUserName,
        string $ftpDomain,
        string $ftpUserName,
        string $passwordByPass,
        string $path
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function fetchFTPAccounts(
        string $serverUserName,
        string $selectedDomain
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function deleteFTPAccount(
        string $serverUserName,
        string $ftpUsername
    ): array;
}
