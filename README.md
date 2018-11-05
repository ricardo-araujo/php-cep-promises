# PHP - Cep Promises

Projeto para fins de estudo que usa [promises](https://github.com/guzzle/promises) para realizar requisições em API's que fornecem endereços de determinado cep.

Ao completar a requisição, o html é parseado de acordo com o que é oferecido pela estrutura do devido serviço e por fim, uma classe que implementa ParserInterface é retornado;

## Uso:

```php
require __DIR__ . '/vendor/autoload.php';

$client = new \GuzzleHttp\Client();

$po = new \CEP\PageObject($client);

$result = $po->get('07191190');

var_dump($result);
var_dump($result->logradouro());
var_dump($result->bairro());
var_dump($result->municipio());
var_dump($result->uf());
var_dump($result->cep());
var_dump($result->origin()); //api de origem da informação

```


