<?php
namespace TotalVoice;

use TotalVoice\Handler\Http;

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
}