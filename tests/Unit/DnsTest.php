<?php

namespace Gkimani\CyberPanel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Gkimani\CyberPanel\Dns;

class DnsTest extends TestCase
{
    #[covers(Gkimani\CyberPanel\Dns::createDNSRecord)]
    public function testCreateDNSRecord(): void
    {
        $cyberPanelClient = new Dns('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->createDNSRecord(
            'admin',
            'cyberpanel.net',
            'heyss',
            '192.168.100.1',
            1400,
            'A'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Dns::fetchDNSRecords)]
    public function testFetchDnsRecords(): void
    {
        $cyberPanelClient = new Dns('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->fetchDNSRecords(
            'admin',
            'cyberpanel.net',
            'aRecord'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Dns::deleteDNSRecord)]
    public function testDeleteDNSRecord(): void
    {
        $cyberPanelClient = new Dns('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->deleteDNSRecord(
            'admin',
            304
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }
}