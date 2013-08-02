<?php

namespace RPMInfo\Test;

use RPMInfo\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{

    public function testParseEdgeCases()
    {
        $parser = new Parser;

        $info = $parser->parse('Install Date: Fri Aug  2 10:07:49 2013         Build Host: bfb1-551.network.ipcdigital.co.uk');

        $this->assertEquals('Fri Aug  2 10:07:49 2013', $info->install_date);
    }

    public function testParseWithFullValidString()
    {
        $description = <<<EOL
Basesystem defines the components of a basic CentOS system (for
example, the package installation order to use during bootstrapping).
Basesystem should be the first package installed on a system, and it
should never be removed.
EOL;

        $validRpmInfo = <<<EOL
Name        : basesystem                   Relocations: (not relocatable)
Version     : 8.0                               Vendor: CentOS
Release     : 5.1.1.el5.centos              Build Date: Wed 28 Mar 2007 04:58:19 AM BST
Install Date: Tue 10 Jul 2012 12:59:55 PM BST      Build Host: builder6
Group       : System Environment/Base       Source RPM: basesystem-8.0-5.1.1.el5.centos.src.rpm
Size        : 0                                License: public domain
Signature   : DSA/SHA1, Wed 04 Apr 2007 01:20:20 AM BST, Key ID a8a447dce8562897
Summary     : The skeleton package which defines a simple CentOS system.
Description :
{$description}
EOL;

        $parser = new Parser;
        $info = $parser->parse($validRpmInfo);

        $this->assertEquals('basesystem', $info['name']);
        $this->assertEquals('(not relocatable)', $info['relocations']);
        $this->assertEquals('8.0', $info['version']);
        $this->assertEquals('CentOS', $info['vendor']);
        $this->assertEquals('5.1.1.el5.centos', $info['release']);
        $this->assertEquals('Wed 28 Mar 2007 04:58:19 AM BST', $info['build_date']);
        $this->assertEquals('Tue 10 Jul 2012 12:59:55 PM BST', $info['install_date']);
        $this->assertEquals('builder6', $info['build_host']);
        $this->assertEquals('System Environment/Base', $info['group']);
        $this->assertEquals('basesystem-8.0-5.1.1.el5.centos.src.rpm', $info['source_rpm']);
        $this->assertEquals('0', $info['size']);
        $this->assertEquals('public domain', $info['license']);
        $this->assertEquals('DSA/SHA1, Wed 04 Apr 2007 01:20:20 AM BST, Key ID a8a447dce8562897', $info['signature']);
        $this->assertEquals('The skeleton package which defines a simple CentOS system.', $info['summary']);
        $this->assertEquals($description, $info['description']);
        $this->assertNull($info['url']);
    }

    public function testInvalidInfoShouldBeNull()
    {
        $parser = new Parser;
        $info = $parser->parse('');

        foreach ($info as $key => $value) {
            $this->assertNull($value);
        }
    }

}
