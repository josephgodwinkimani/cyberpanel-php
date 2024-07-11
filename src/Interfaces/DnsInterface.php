<?php

namespace Gkimani\CyberPanel\Interfaces;

use Exception;
use RuntimeException;

interface DnsInterface
{
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function createDNSRecord(
        string $serverUserName,
        string $selectedZone,
        string $recordName,
        string $recordContentA,
        int $ttl,
        string $recordType
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function fetchDNSRecords(
        string $serverUserName,
        string $selectedZone,
        string $currentSelection
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function deleteDNSRecord(
        string $serverUserName,
        string $id
    ): array;
}
