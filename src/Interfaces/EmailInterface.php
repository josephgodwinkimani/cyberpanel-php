<?php

namespace Gkimani\CyberPanel\Interfaces;

use Exception;
use RuntimeException;

interface EmailInterface
{
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function createEmailAccount(
        string $serverUserName,
        string $domain,
        string $username,
        string $passwordByPass
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function fetchEmailAccounts(
        string $serverUserName,
        string $domain
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function deleteEmailAccount(
        string $serverUserName,
        string $email
    ): array;
}
