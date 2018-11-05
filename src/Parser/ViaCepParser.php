<?php

namespace CEP\Parser;

final class ViaCepParser extends DefaultParser
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

        return $result['localidade'];
    }

    public function uf()
    {
        $result = json_decode($this->byText('//body/p'), true);

        return $result['uf'];
    }

    public function cep()
    {
        $result = json_decode($this->byText('//body/p'), true);

        return $result['cep'];
    }

    public function origin()
    {
        return 'Via Cep';
    }
}