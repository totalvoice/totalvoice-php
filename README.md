# totalvoice-php
Cliente em PHP para API da Totalvoice

> ### Funcionalidades

- Gerenciamento das chamadas
- Consulta e envio de SMS
- Consulta e envio de TTS
- Consulta e envio de Audio
- Gerenciamento da Conta
- Gerenciamento da Central

> ### Requisitos

- PHP 5.5+
- Autoloader compatível com a PSR-4
- PHP deve estar compilado com a lib-curl

> ### Instalação

Para instalar a biblioteca basta adicioná-la via [composer](https://getcomposer.org/download/)

```composer
composer require total-voice/php-client 0.0.1-rc
```

Ou no composer.json

```json
{
    "total-voice/php-client": "0.0.1-rc"
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

Para utilizar esta biblioteca, primeiramente você deverá realizar um cadastro no site da [Total Voice API](http://www.totalvoice.com.br/api/).
Após a criação do cadastro será disponibilizado um AccessToken para acesso a API.

Com o AccessToken em mãos será possível realizar as consultas/cadastros conforme documentação da [API](https://api.totalvoice.com.br/doc/#/)

A seguir um pequeno exemplo de como pode ser utilizada esta biblioteca.

> ##### Realiza uma chamada telefônica entre dois números: A e B

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use Total\Client;
use TotalVoice\Chamada\ChamadaService;
use TotalVoice\ClientException;

try {
    
    $client = new Client('{YOUR-ACCESS-TOKEN}');
    $service = new ChamadaService($client);
    $response = $service->ligar('NUMERO-A', 'NUMERO-B');
    echo $response;

} catch(ClientException $ex) {
    echo $ex->getMessage();
}
```

> ##### Consulta de chamada pelo ID

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client;
use TotalVoice\Chamada\ChamadaService;
use TotalVoice\ClientException;

try {
    
    $client = new Client('{YOUR-ACCESS-TOKEN}');
    $service = new ChamadaService($client);
    $response = $service->buscaChamada('ID_CHAMADA');
    echo $response; // {}

} catch(ClientException $ex) {
    echo $ex->getMessage();
}
```


> ##### Encerra uma chamada ativa

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client;
use TotalVoice\Chamada\ChamadaService;
use TotalVoice\ClientException;

try {
    
    $client = new Client('{YOUR-ACCESS-TOKEN}');
    $service = new ChamadaService($client);
    $response = $service->encerrar('ID_CHAMADA');
    echo $response; // {}

} catch(ClientException $ex) {
    echo $ex->getMessage();
}
```

> ##### Envio de SMS

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client;
use TotalVoice\SMS\SMSService;
use TotalVoice\ClientException;

try {
    
    $client = new Client('{YOUR-ACCESS-TOKEN}');
    $service = new SMSService($client);
    $response = $service->enviar('NUMERO-DESTINO', 'MENSAGEM');
    echo $response; // {}

} catch(ClientException $ex) {
    echo $ex->getMessage();
}
```

> ##### Envio de TTS

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client;
use TotalVoice\TTS\TTSService;
use TotalVoice\ClientException;

try {
    
    $client = new Client('{YOUR-ACCESS-TOKEN}');
    $service = new TTSService($client);
    $response = $service->enviar('NUMERO-DESTINO', 'MENSAGEM');
    echo $response; // {}

} catch(ClientException $ex) {
    echo $ex->getMessage();
}
```

> ##### Envio de Audio

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client;
use TotalVoice\Audio\AudioService;
use TotalVoice\ClientException;

try {
    
    $client = new Client('{YOUR-ACCESS-TOKEN}');
    $service = new AudioService($client);
    $response = $service->enviar('NUMERO-DESTINO', 'MENSAGEM');
    echo $response; // {}

} catch(ClientException $ex) {
    echo $ex->getMessage();
}
```

> ##### Configurações de central telefonica

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client;
use TotalVoice\Central\CentralService;
use TotalVoice\ClientException;

try {
    
    $client = new Client('{YOUR-ACCESS-TOKEN}');
    $service = new CentralService($client);
    $response = $service->buscaRamal('ID-RAMAL');
    echo $response; // {}

} catch(ClientException $ex) {
    echo $ex->getMessage();
}
```

> ##### Gerenciamento dos dados da Conta

```php
<?php
// Considero que já existe um autoloader compatível com a PSR-4 registrado

use TotalVoice\Client;
use TotalVoice\Conta\GerenciadorContaService;
use TotalVoice\ClientException;

try {
    
    $client = new Client('{YOUR-ACCESS-TOKEN}');
    $service = new GerenciadorContaService($client);
    $response = $service->buscaConta('ID_CONTA');
    echo $response; // {}

} catch(ClientException $ex) {
    echo $ex->getMessage();
}
```

Mais informações sobre os métodos disponíveis podem ser encontrados na documentação da [API](https://api.totalvoice.com.br/doc/#/)

> ### Licença

Esta biblioteca segue os termos de uso da [MIT](https://github.com/DiloWagner/tvce-client/blob/master/LICENSE)

# Em construção - aguarde!
