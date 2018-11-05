<?php

namespace CEP\Parser;

final class PostmonAPIParser extends DefaultParser
{
    public function logradouro()
    {
        $result = json_decode($this->byText('//body/p'), true);

        return $result['logradouro'];
    }

    public function bairro()
    {
        $result = json_decode($this->byText('//body/p'), true);

        return $result['bairro'];
    }

    public function municipio()
    {
        $result = json_decode($this->byText('//body/p'), true);

        return $result['cidade'];
    }

    public function uf()
    {
        $result = json_decode($this->byText('//body/p'), true);

        return $result['estado'];
    }

    public function cep()
    {
        $result = json_decode($this->byText('//body/p'), true);

        return $result['cep'];
    }

    public function origin()
    {
        return 'Postmon API';
    }
}