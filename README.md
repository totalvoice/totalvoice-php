# totalvoice-php
Cliente em PHP para API da Totalvoice

[![Build Status](https://travis-ci.org/totalvoice/totalvoice-php.svg?style=flat-square)](http://travis-ci.org/#!/totalvoice/totalvoice-php)
[![Packagist](https://img.shields.io/packagist/v/total-voice/php-client.svg?style=flat-square)](https://github.com/totalvoice/totalvoice-php)

> ### Funcionalidades

- Gerenciamento das chamadas
- Consulta e envio de SMS
- Consulta e envio de TTS
- Consulta e envio de Audio
- Consulta e envio de Composto
- Consulta e envio de Conferência
- Gerenciamento da Conta
- Gerenciamento da Central
- Gerenciamento de DID

> ### Requisitos

- PHP 5.5+
- Autoloader compatível com a PSR-4
- PHP deve estar compilado com a lib-curl

> ### Instalação

Para instalar a biblioteca basta adicioná-la via [composer](https://getcomposer.org/download/)

```composer
composer require total-voice/php-client 1.*
```

Ou no composer.json

```json
{
    "total-voice/php-client": "1.*"
}
```

> ### Testes

Podemos usar o composer para rodar os testes:

```composer
composer test
```
ou utilizando o .phar

```composer
php composer.phar test
```

> ### Utilização

Para utilizar esta biblioteca, primeiramente você deverá realizar um cadastro no site da [Total Voice](http://www.totalvoice.com.br).
Após a criação do cadastro será disponibilizado um AccessToken para acesso a API.

Com o AccessToken em mãos será possível realizar as consultas/cadastros conforme documentação da [API](https://api.totalvoice.com.br/doc/#/)

Os métodos da API que poderão ser invocados:
- audio
- central
- chamada
- composto
- conferencia
- conta
- perfil
- sms
- tts

A seguir um pequeno exemplo de como pode ser utilizada esta biblioteca.

> ##### Realiza uma chamada telefônica entre dois números: A e B

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;

$client = new TotalVoiceClient('access-token');
$response = $client->chamada->ligar('NUMERO-A', 'NUMERO-B');

echo $response->getContent();

```

> ##### Consulta de chamada pelo ID

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;

$client = new TotalVoiceClient('access-token');
$response = $client->chamada->buscaChamada('ID_CHAMADA');

echo $response->getContent(); // {}

```


> ##### Encerra uma chamada ativa

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;

$client = new TotalVoiceClient('access-token');
$response = $client->chamada->encerrar('ID_CHAMADA');

echo $response->getContent(); // {}

```

> ##### Envio de SMS

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;

$client = new TotalVoiceClient('access-token');
$response = $client->sms->enviar('NUMERO-DESTINO', 'SUA MENSAGEM');

echo $response->getContent(); // {}
    
```

> ##### Envio de TTS

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;

$client = new TotalVoiceClient('access-token');
$response = $client->tts->enviar('NUMERO-DESTINO', 'SUA MENSAGEM');

echo $response->getContent(); // {}
    
```

> ##### Envio de Audio

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;

$client = new TotalVoiceClient('access-token');
$response = $client->audio->enviar('NUMERO-DESTINO', 'SUA MENSAGEM');

echo $response->getContent(); // {}

```

> ##### Configurações de central telefonica

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;
    
$client = new TotalVoiceClient('access-token');
$response = $client->central->buscaRamal('ID-RAMAL');

echo $response->getContent(); // {}
    
```

> ##### Gerenciamento dos dados da Conta

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;

$client = new TotalVoiceClient('access-token');
$response = $client->conta->buscaConta('ID_CONTA');

echo $response->getContent(); // {}

```

> ##### Consulta saldo da Minha Conta

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;

$client = new TotalVoiceClient('access-token');
$response = $client->perfil->consultaSaldo();

echo $response->getContent(); // {}

```

> ##### Todas as classes da API podem ser instânciadas separadamente também

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;
use TotalVoice\Api\Chamada;

$client = new TotalVoiceClient('access-token');
$service = new Chamada($client);
$response = $service->ligar('NUMERO-A', 'NUMERO-B');

echo $response->getContent();

```

> ##### Caso você utilize um Client personalizado

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Api\Chamada;

class MeuClient implements ClientInterface 
{

}

$meuclient = new MeuClient('access-token');
$service = new Chamada($meuclient);
$response = $service->ligar('NUMERO-A', 'NUMERO-B');

```

> ##### Caso você necessite utilizar seu próprio endereço configurado na Total Voice

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client as TotalVoiceClient;
use TotalVoice\Api\Chamada;

$client = new TotalVoiceClient('access-token', 'https://meuhost.com.br');
$service = new Chamada($client);
$response = $service->ligar('NUMERO-A', 'NUMERO-B');

```
> #### Listando dids no estoque

```php
<?php

use TotalVoice\Client as TotalVoiceClient;
use TotalVoice\Api\Chamada;

$client = new TotalVoiceClient('access-token');
$response = $client->did->listaEstoque();

```

> #### Adquirindo um did

```php
<?php

use TotalVoice\Client as TotalVoiceClient;
use TotalVoice\Api\Chamada;

$client = new TotalVoiceClient('access-token');
$idDid = "10";
$response = $client->did->adquirir($idDid);

```

> #### Editando um did

```php
<?php

use TotalVoice\Client as TotalVoiceClient;
use TotalVoice\Api\Chamada;

$client = new TotalVoiceClient('access-token');
$didId = "11";
$uraId = null;
$response = $client->did->atualizar($idDid, $ramalId, $uraId);

```

> #### Deletando um did

```php
<?php

use TotalVoice\Client as TotalVoiceClient;
use TotalVoice\Api\Chamada;

$client = new TotalVoiceClient('access-token');
$didId = "11";
$response = $client->did->excluir($didId);

```

> #### Listando seus dids

```php
<?php

use TotalVoice\Client as TotalVoiceClient;
use TotalVoice\Api\Chamada;

$client = new TotalVoiceClient('access-token');
$response = $client->did->lista();
```


Mais informações sobre os métodos disponíveis podem ser encontrados na documentação da [API](https://api.totalvoice.com.br/doc/#/)

> ### Contribua!

Quer contribuir? [clique aqui](https://github.com/totalvoice/totalvoice-php/blob/master/CONTRIBUTING.md)

> ### Licença

Esta biblioteca segue os termos de uso da [MIT](https://github.com/totalvoice/totalvoice-php/blob/master/LICENSE)
