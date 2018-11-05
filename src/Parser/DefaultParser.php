<?php

namespace CEP\Parser;

use Symfony\Component\DomCrawler\Crawler;

abstract class DefaultParser implements ParserInterface
{
    protected $dom;

    public function __construct($html, $encoding = 'UTF-8')
    {
        $this->dom = new Crawler();
        $this->dom->addHtmlContent($html, $encoding);
    }

    protected function getHtml()
    {
        return $this->dom->html();
    }

    public function asArray()
    {
        return [
            'logradouro' => $this->logradouro(),
            'bairro' => $this->bairro(),
            'municipio' => $this->municipio(),
            'uf' => $this->uf(),
            'cep' => $this->cep(),
            'origin' => $this->origin()
        ];
    }

    public function asJson()
    {
        return json_encode($this->asArray());
    }

    public function asObject()
    {
        $class = new \stdClass();
        $class->logradouro = $this->logradouro();
        $class->bairro = $this->bairro();
        $class->municipio = $this->municipio();
        $class->uf = $this->uf();
        $class->cep = $this->cep();
        return $class;
    }

    protected function byText($xpath)
    {
        try {

            return clean_string($this->dom->filterXPath($xpath)->text());

        } catch (\Exception $e) {

            return null;

        }
    }

    protected function byAttribute($xpath, $attr)
    {
        try {

            return clean_string($this->dom->filter($xpath)->attr($attr));

        } catch (\Exception $e) {

            return null;

        }
    }

    public function __debugInfo()
    {
        return $this->asArray();
    }
}