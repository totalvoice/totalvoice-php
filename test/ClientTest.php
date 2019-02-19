<?php
namespace TotalVoice;

use TotalVoice\Handler\Http;
use TotalVoice\Api\Api;
use TotalVoice\Api\ApiRelatorio;
use TotalVoice\Api\ApiRelatorioChamadas;
use TotalVoice\Api\Audio;
use TotalVoice\Api\Bina;
use TotalVoice\Api\Central;
use TotalVoice\Api\Chamada;
use TotalVoice\Api\Composto;
use TotalVoice\Api\Conferencia;
use TotalVoice\Api\Conta;
use TotalVoice\Api\Did;
use TotalVoice\Api\Fila;
use TotalVoice\Api\Perfil;
use TotalVoice\Api\Sms;
use TotalVoice\Api\Status;
use TotalVoice\Api\Tts;
use TotalVoice\Api\Verificacao;
use TotalVoice\Api\ValidaNumero;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp()
    {
        $this->client = new Client('my-access-token', 'https://example.org');
    }

    /**
     * @test
     */
    public function constructShouldConfigureTheAttributes()
    {
        $this->assertAttributeSame('my-access-token', 'accessToken', $this->client);
        $this->assertAttributeSame('https://example.org', 'baseUri', $this->client);
    }

    /**
     * @test
     */
    public function methodBuildRequestShouldInicializeTheCurlResource()
    {
        $route = new Route();
        $resource = $this->client->buildRequest($route, Http::GET);
        $this->assertEquals('object', gettype($resource));
    }

    /**
     * @test
     */
    public function queryTest()
    {
        $query = $this->client->query([]);
        $this->assertEquals('', $query);

        $query = $this->client->query(['query' => 'string']);
        $this->assertEquals("?query=string", $query);
    }

    /**
     * @test
     */
    public function apiInstancesTest()
    {
        $audio = $this->client->audio;
        $bina = $this->client->bina;
        $central = $this->client->central;
        $chamada = $this->client->chamada;
        $composto = $this->client->composto;
        $conferencia = $this->client->conferencia;
        $conta = $this->client->conta;
        $did = $this->client->did;
        $fila = $this->client->fila;
        $perfil = $this->client->perfil;
        $sms = $this->client->sms;
        $status = $this->client->status;
        $tts = $this->client->tts;
        $verificacao = $this->client->verificacao;
        $validaNumero = $this->client->valida_numero;

        $this->assertInstanceOf(Audio::class, $audio);
        $this->assertInstanceOf(Bina::class, $bina);
        $this->assertInstanceOf(Central::class, $central);
        $this->assertInstanceOf(Chamada::class, $chamada);
        $this->assertInstanceOf(Composto::class, $composto);
        $this->assertInstanceOf(Conferencia::class, $conferencia);
        $this->assertInstanceOf(Conta::class, $conta);
        $this->assertInstanceOf(Did::class, $did);
        $this->assertInstanceOf(Fila::class, $fila);
        $this->assertInstanceOf(Perfil::class, $perfil);
        $this->assertInstanceOf(Sms::class, $sms);
        $this->assertInstanceOf(Status::class, $status);
        $this->assertInstanceOf(Tts::class, $tts);
        $this->assertInstanceOf(Verificacao::class, $verificacao);
        $this->assertInstanceOf(ValidaNumero::class, $validaNumero);
    }

    /**
     * @test
     */
    public function apiThrowClientException()
    {
        $name = 'invalidapiitem';
        $this->expectException(ClientException::class);
        $this->expectExceptionMessage("Não foi possível instanciar a classe: $name");
        $this->client->$name;
    }
}