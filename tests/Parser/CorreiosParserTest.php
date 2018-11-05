<?php

namespace CEP\Tests;

use CEP\Parser\CorreiosParser;

class CorreiosParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CorreiosParser
     */
    protected $parser;

    protected function setUp()
    {
        $this->parser = new CorreiosParser(file_get_contents(__DIR__ . '/../resources/correios.html'));
    }

    public function testBairro()
    {
        $this->assertNotEmpty($this->parser->bairro());
    }

    public function testCep()
    {
        $this->assertNotEmpty($this->parser->cep());
    }

    public function testUf()
    {
        $this->assertNotEmpty($this->parser->uf());
    }

    public function testLogradouro()
    {
        $this->assertNotEmpty($this->parser->logradouro());
    }

    public function testMunicipio()
    {
        $this->assertNotEmpty($this->parser->municipio());
    }
}
