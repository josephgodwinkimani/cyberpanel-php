<?php

namespace Gkimani\CyberPanel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Gkimani\CyberPanel\Package;

class PackageTest extends TestCase
{
    #[covers(Gkimani\CyberPanel\Package::createPackage)]
    public function testCreatePackage(): void
    {
        $cyberPanelClient = new Package('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->createPackage(
            'admin',
            'TestPac',
            '100',
            '100',
            '100', // no. of allowed databases
            '100', // no. of allowed ftp accounts
            '100', // no. of allowed email accounts
            '1', // no. of allowed domains 
            '1', // allow api access
            '1' // allow full domain 1=yes 0=no
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Package::modifyPackage)]
    public function testModifyPackage(): void
    {
        $cyberPanelClient = new Package('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->modifyPackage(
            'admin',
            'TestPac',
            '100',
            '100',
            '100', // no. of allowed databases
            '100', // no. of allowed ftp accounts
            '100', // no. of allowed email accounts
            '1', // no. of allowed domains 
            '1', // allow api access
            '1' // allow full domain 1=yes 0=no
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Package::fetchPackages)]
    public function testFetchPackages(): void
    {
        $cyberPanelClient = new Package('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->fetchPackages(
            'TestPac'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\Package::deletePackage)]
    public function testDeletePackages(): void
    {
        $cyberPanelClient = new Package('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->deletePackage(
            'admin',
            'TestPac'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }
}