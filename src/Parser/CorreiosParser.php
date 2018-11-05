<?php

namespace CEP\Parser;

final class CorreiosParser extends DefaultParser
{
    public function logradouro()
    {
        return $this->byText('//table[@class="tmptabela"]/tr[2]/td[1]');
    }

    public function bairro()
    {
        return $this->byText('//table[@class="tmptabela"]/tr[2]/td[2]');
    }

    public function municipio()
    {
        $text = $this->byText('//table[@class="tmptabela"]/tr[2]/td[3]');

        return explode('/', $text)[0];
    }

    public function uf()
    {
        $text = $this->byText('//table[@class="tmptabela"]/tr[2]/td[3]');

        return explode('/', $text)[1];
    }

    public function cep()
    {
        return $this->byText('//table[@class="tmptabela"]/tr[2]/td[4]');
    }

    public function origin()
    {
        return 'Correios';
    }
}