<?php

namespace Gkimani\CyberPanel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Gkimani\CyberPanel\Ftp;

class FtpTest extends TestCase
{
    #[covers(Gkimani\CyberPanel\Ftp::createFtpAccount)]
    public function testCreateFTPAccount(): void
    {
        $cyberPanelClient = new Ftp('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->createFTPAccount(
            'admin',
            'cyberpanel.net',
            'cyberftpadmin',
            '8tohEqfGtqeeFbH8',
            ''
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Ftp::fetchFTPAccounts)]
    public function testFetchFTPAccounts(): void
    {
        $cyberPanelClient = new Ftp('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->fetchFTPAccounts(
            'admin',
            'cyberpanel.net'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Ftp::deleteFTPAccount)]
    public function testDeleteFTPAccount(): void
    {
        $cyberPanelClient = new Ftp('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->deleteFTPAccount(
            'admin',
            'cyberftpadmin',
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }
}