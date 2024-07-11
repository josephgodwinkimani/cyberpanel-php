<?php

namespace Gkimani\CyberPanel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Gkimani\CyberPanel\Website;

class WebsiteTest extends TestCase
{
    #[covers(Gkimani\CyberPanel\Website::createWebsite)]
    public function testCreateWebsite(): void
    {
        $cyberPanelClient = new Website('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->createWebsite(
            'admin',
            'cyberpanel.net',
            'Default',
            'usman@cyberpersons.com',
            'PHP 8.1',
            'admin',
            0,
            0,
            0
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Website::changeWebsitePHPVersion)]
    public function testChangeWebsitePHPVersion(): void
    {
        $cyberPanelClient = new Website('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->changeWebsitePHPVersion(
            'admin',
            'cyberpanel.net',
            'PHP 8.1'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);
    }

    #[covers(Gkimani\CyberPanel\Website::changeLinuxUserPassword)]
    public function testChangeWebsiteLinuxUserPassword(): void
    {
        $cyberPanelClient = new Website('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->changeWebsiteLinuxUserPassword(
            'admin',
            'cyberpanel.net',
            'cyberpanel'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);
    }

    #[covers(Gkimani\CyberPanel\Website::fetchWebsites)]
    public function testFetchWebsites(): void
    {
        $cyberPanelClient = new Website('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->fetchWebsites(
            'admin',
            'cyberpanel.net',
            'page'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);
    }

    #[covers(Gkimani\CyberPanel\Website::deleteWebsite)]
    public function testDeleteWebsite(): void
    {
        $cyberPanelClient = new Website('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->deleteWebsite(
            'admin',
            'cyberpanel.net',
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }
}