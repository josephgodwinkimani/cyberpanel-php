<?php

namespace Gkimani\CyberPanel\Interfaces;

use Exception;
use RuntimeException;

interface DatabaseInterface
{
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function createDatabase(
        string $serverUserName,
        string $databaseWebsite,
        string $dbName,
        string $dbUsername,
        int $dbPassword,
        string $webUserName
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function fetchDatabases(
        string $serverUserName,
        string $databaseWebsite
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function deleteDatabase(
        string $serverUserName,
        string $dbName
    ): array;
}
