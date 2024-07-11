<?php

namespace Gkimani\CyberPanel\Interfaces;

use Exception;
use RuntimeException;

interface UserInterface
{
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function verifyLogin(string $serverUserName): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function createUser(
        string $serverUserName,
        string $firstName,
        string $lastName,
        string $email,
        string $userName,
        string $password,
        int $websiteLimit,
        string $selectedACL
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function fetchUsers(string $serverUserName): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function modifyUser(
        string $serverUserName,
        string $firstName,
        string $lastName,
        string $email,
        string $userName,
        string $securityLevel,
        int $twofa,
        string $passwordByPass
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function changeUserACL(
        string $serverUserName,
        string $selectedUser,
        string $selectedACL
    ): array;
    /**
     * @throws Exception|RuntimeException // Allow RuntimeException for unexpected errors
     */
    public function deleteUser(
        string $serverUserName,
        string $accountUsername
    ): array;
}
