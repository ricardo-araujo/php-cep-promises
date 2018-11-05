<?php

namespace CEP\Tests;

class UtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testUtilsFunctions()
    {
        $this->assertEquals('07191190', only_numbers('07191-190'));
        $this->assertEquals('07191190', cep_padder('7191190'));
    }
}
