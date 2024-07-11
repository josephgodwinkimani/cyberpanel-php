<?php

namespace Gkimani\CyberPanel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Gkimani\CyberPanel\ChildDomain;

class ChildDomainTest extends TestCase
{
    #[covers(Gkimani\CyberPanel\ChildDomain::createChildDomain)]
    public function testChildDomain(): void
    {
        $cyberPanelClient = new ChildDomain('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->createChildDomain(
            'admin',
            'cyberpanel.net',
            'blog.cyberpanel.net',
            'Default',
            'usman@cyberpersons.com',
            'PHP 8.1',
            'admin',
            'blog',
            0,
            0,
            0
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\ChildDomain::changeWebsitePHPVersion)]
    public function testChangeWebsitePHPVersion(): void
    {
        $cyberPanelClient = new ChildDomain('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->changeWebsitePHPVersion(
            'admin',
            'blog.cyberpanel.net',
            'PHP 8.1'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);
    }

    #[covers(Gkimani\CyberPanel\ChildDomain::fetchWebsites)]
    public function testFetchChildDomain(): void
    {
        $cyberPanelClient = new ChildDomain('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->fetchChildDomains(
            'admin',
            'cyberpanel.net', // master domain or parent domain e.g. cyberpanel.net is parent of blog.cyberpanel.net
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);
    }

    #[covers(Gkimani\CyberPanel\ChildDomain::deleteChildDomain)]
    public function testDeleteChildDomain(): void
    {
        $cyberPanelClient = new ChildDomain('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->deleteChildDomain(
            'admin',
            'blog.cyberpanel.net',
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

}