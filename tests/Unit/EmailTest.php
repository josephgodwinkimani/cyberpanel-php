<?php

namespace Gkimani\CyberPanel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Gkimani\CyberPanel\Email;

class EmailTest extends TestCase
{
    #[covers(Gkimani\CyberPanel\Email::createEmailAccount)]
    public function testCreateEmailAccount(): void
    {
        $cyberPanelClient = new Email('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->createEmailAccount(
            'admin',
            'cyberpanel.net',
            'heyss',
            '8tohEqfGtqeeFbH8'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Email::fetchEmailAccounts)]
    public function testFetchEmailAccounts(): void
    {
        $cyberPanelClient = new Email('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->fetchEmailAccounts(
            'admin',
            'cyberpanel.net'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Email::deleteEmailAccount)]
    public function testDeleteEmailAccount(): void
    {
        $cyberPanelClient = new Email('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->deleteEmailAccount(
            'admin',
            'support@cyberpanel.net'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }
}