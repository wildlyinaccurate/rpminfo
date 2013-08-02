<?php

namespace RPMInfo\Test;

use RPMInfo\Info;

class InfoTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider provider
     */
    public function testSettingByArrayWorks($key, $value)
    {
        $info = new Info;

        $info[$key] = $value;

        $this->assertEquals($value, $info[$key]);
        $this->assertEquals($value, $info->{$key});
    }

    /**
     * @dataProvider provider
     */
    public function testSettingByObjectWorks($key, $value)
    {
        $info = new Info;

        $info->{$key} = $value;

        $this->assertEquals($value, $info[$key]);
        $this->assertEquals($value, $info->{$key});
    }

    public function provider()
    {
        return array(
            array('name', 'Foo'),
            array('version', '1.0'),
            array('something', array('foo', 'bar')),
        );
    }

}
