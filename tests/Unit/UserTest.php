<?php

namespace Gkimani\CyberPanel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Gkimani\CyberPanel\User;

class UserTest extends TestCase
{
    #[covers(Gkimani\CyberPanel\User::verifyLogin)]
    public function testVerifyLogin(): void
    {
        $cyberPanelClient = new User('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->verifyLogin(
            'admin'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\User::createUser)]
    public function testCreateUser(): void
    {
        $cyberPanelClient = new User('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->createUser(
            'admin',
            'Usman',
            'Nasir',
            'usman@cyberpersons.com',
            'usmannasir', // username
            'cyberpanel', // password
            5, // website limit
            'user' // acl
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\User::fetchUsers)]
    public function testFetchUsers(): void
    {
        $cyberPanelClient = new User('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->fetchUsers(
            'admin'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\User::fetchUsers)]
    public function testModifyUser(): void
    {
        $cyberPanelClient = new User('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->modifyUser(
            'admin',
            'usmannasir', // username
            'Usman',
            'Nasir',
            'support@cyberpanel.net', // email
            'support@cyberpanel.net', // security level
            0,
            'cyberpanel'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\User::changeUserACL)]
    public function testChangeUserACL(): void
    {
        $cyberPanelClient = new User('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->changeUserACL(
            'admin',
            'usmannasir',
            'user' // selected ACL e.g. admin, reseller, user
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }

    #[covers(Gkimani\CyberPanel\User::deleteUser)]
    public function testDeleteUser(): void
    {
        $cyberPanelClient = new User('https://panel.cyberpanel.net', 'admin', 'password');
        $response = $cyberPanelClient->deleteUser(
            'admin',
            'usmannasir'
        );

        // var_dump($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(1, $response['status']);

    }
}