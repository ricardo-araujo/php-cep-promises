<?php

namespace CEP\Parser;

interface ParserInterface
{
    public function logradouro();

    public function bairro();

    public function municipio();

    public function uf();

    public function cep();

    public function origin();
}