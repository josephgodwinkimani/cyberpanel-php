<?php

namespace Gkimani\CyberPanel\Interfaces;

use Exception;
use RuntimeException;

interface BackupInterface
{
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function createBackup(string $serverUserName, string $websiteToBeBacked): array;
}
