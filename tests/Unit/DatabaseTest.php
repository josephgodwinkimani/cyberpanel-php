<?php

namespace Gkimani\CyberPanel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Gkimani\CyberPanel\Database;

class DatabaseTest extends TestCase
{
    #[covers(Gkimani\CyberPanel\Database::createDatabase)]
    public function testCreateDatabase(): void
    {
        $cyberPanelClient = new Database('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->createDatabase(
            'admin',
            'cyberpanel.net',
            'wpblogdatabase', // name of database
            'usmanss', // database username
            '8tohEqfGtqeeFbH8', // database password
            'cyber'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Database::fetchDatabases)]
    public function testFetchDatabases(): void
    {
        $cyberPanelClient = new Database('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->fetchDatabases(
            'admin',
            'cyberpanel.net'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Database::deleteDatabase)]
    public function testDeleteDatabase(): void
    {
        $cyberPanelClient = new Database('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->deleteDatabase(
            'admin',
            'wpblogdatabase'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }
}