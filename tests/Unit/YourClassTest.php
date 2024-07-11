<?php

namespace Gkimani\Skeleton\Tests;

use Gkimani\Skeleton\YourClass;
use PHPUnit\Framework\TestCase;

class YourClassTest extends TestCase
{
    #[covers(Gkimani\Skeleton\YourClass::greet)]
    public function testGreet()
    {
        $yourClass = new YourClass();
        $this->assertEquals("Hello, John!", $yourClass->greet("John"));
    }

    #[covers(Gkimani\Skeleton\YourClass::add)]
    public function testAdd()
    {
        $yourClass = new YourClass();
        $this->assertEquals(5.0, $yourClass->add(2.5, 2.5));
    }
}