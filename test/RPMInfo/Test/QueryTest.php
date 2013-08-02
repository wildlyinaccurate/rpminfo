<?php

namespace RPMInfo\Test;

use RPMInfo\Query;

class QueryTest extends \PHPUnit_Framework_TestCase
{

    public function testGetInfo()
    {
        $rpm = exec('which rpm');

        if ( ! $rpm) {
            throw new \DomainException('Tests must be run on a system with `rpm` installed');
        }

        // Makes the tests a little brittle, but better than relying on a
        // specific package to exist on the test system.
        $package = exec('rpm -qa | head -n 1');

        $query = new Query($package);
        $info = $query->getInfo();

        $this->assertInstanceOf('RPMInfo\Info', $info);
    }

}
