<?php

namespace RPMInfo\Test;

use RPMInfo\Query;

class QueryTest extends \PHPUnit_Framework_TestCase
{

    public function testGetInfo()
    {
        if ( ! exec('which rpm')) {
            $this->markTestSkipped('Integration tests can only be run on systems with rpm');
        }

        // Makes the tests a little brittle, but better than relying on a
        // specific package to exist on the test system.
        $package = exec('rpm -qa | head -n 1');

        $query = new Query($package);
        $info = $query->getInfo();

        $this->assertInstanceOf('RPMInfo\Info', $info);
    }

}
