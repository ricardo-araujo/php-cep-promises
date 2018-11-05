<?php

namespace CEP;

use CEP\Parser\CorreiosParser;
use CEP\Parser\ParserInterface;
use CEP\Parser\PostmonAPIParser;
use CEP\Parser\ViaCepParser;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class PageObject
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $proxy;

    /**
     * PageObject constructor.
     */
    public function __construct(Client $client, $proxy = null)
    {
        $this->client = $client;
        $this->proxy = $proxy;
    }

    /**
     * @return ParserInterface
    */
    public function get($cep)
    {
        $cep = cep_padder(only_numbers($cep));

        return \GuzzleHttp\Promise\any([
            $this->getViaCep($cep),
            $this->getPostmonAPI($cep),
            $this->getCorreios($cep)
        ])->wait();
    }

    public function getViaCep($cep)
    {
        return $this->client
                     ->requestAsync( 'GET', "https://viacep.com.br/ws/{$cep}/json/" , ['proxy' => $this->proxy])
                     ->then(function(ResponseInterface $res) {
                         return new ViaCepParser($res->getBody()->getContents());
                     });
    }

    public function getPostmonAPI($cep)
    {
        return $this->client
                     ->requestAsync('GET', "https://api.postmon.com.br/v1/cep/{$cep}", ['proxy' => $this->proxy])
                     ->then(function(ResponseInterface $res) {
                         return new PostmonAPIParser($res->getBody()->getContents());
                     });
    }

    public function getCorreios($cep)
    {
        return $this->client
                     ->requestAsync('POST', 'http://www.buscacep.correios.com.br/sistemas/buscacep/resultadoBuscaCepEndereco.cfm', [
                         'proxy' => $this->proxy,
                         'form_params' => [
                             'relaxation'=> $cep,
                             'tipoCEP' => 'ALL',
                             'semelhante' => 'N'
                         ]
                     ])
                     ->then(function(ResponseInterface $res) {
                         return new CorreiosParser($res->getBody()->getContents(), 'ISO-8859-1');
                     });
    }
}