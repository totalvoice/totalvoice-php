<?php
namespace TotalVoice;

use TotalVoice\Handler\Curl;
use TotalVoice\Handler\Http;
use TotalVoice\Handler\Response;
use DI\ContainerBuilder;
use DI\NotFoundException;

class Client implements ClientInterface
{
    /**
     * @var string
     */
    const BASE_URI = 'https://api2.totalvoice.com.br';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var resource
     */
    private $resource;

    /**
     * @var Response
     */
    private $response;

    /**
     * Client constructor.
     * @param $accessToken
     * @param $baseUri
     */
    public function __construct($accessToken, $baseUri = self::BASE_URI)
    {
        $this->resource = new Curl();
        $this->response = new Response();
        $this->accessToken = $accessToken;
        $this->baseUri = $baseUri;
    }

    /**
     * Requisição GET
     * @method GET
     * @param RouteInterface $route
     * @param array $params
     * @return string
     */
    public function get(RouteInterface $route, $params = [])
    {
        return $this->buildRequest($route, Http::GET, $params)
                    ->send();
    }

    /**
     * Requisição POST
     * @method POST
     * @param RouteInterface $route
     * @param array $params
     * @return string
     */
    public function post(RouteInterface $route, $data)
    {
        return $this->buildRequest($route, Http::POST, [], $data)
                    ->send();
    }

    /**
     * Requisição PUT
     * @method PUT
     * @param RouteInterface $route
     * @param array $params
     * @return string
     */
    public function put(RouteInterface $route, $data)
    {
        return $this->buildRequest($route, Http::PUT, [], $data)
                    ->send();
    }

    /**
     * Requisição DELETE
     * @method DELETE
     * @param RouteInterface $route
     * @return string
     */
    public function delete(RouteInterface $route)
    {
        return $this->buildRequest($route, Http::DELETE)
                    ->send();
    }

    /**
     * @param RouteInterface $route
     * @param $method
     * @param array $params
     * @param array $data
     * @return Client
     */
    public function buildRequest(RouteInterface $route, $method, $params = [], $data = [])
    {
        $query = $this->query($params);
        $this->defaultHeaders();
        $this->resource->setMethod($method);
        $url = sprintf('%s%s%s', $this->baseUri, $route->build(), $query);
        $this->resource->setUrl($url);
        if(! empty($data)) {
            $this->resource->setBody($data);;
        }

        return $this;
    }

    /**
     * Monta a query string caso haja parâmetros de filtro
     * @param $params
     * @return string
     */
    public function query($params)
    {
        $query = '';
        if(! empty($params)) {
            $query = '?' . http_build_query($params);
        }
        return $query;
    }

    /**
     * Monta os parâmetros padrões do cabeçalho: Content-Type e Access-Token
     * @param void
     */
    private function defaultHeaders()
    {
        $this->resource->addHeader(sprintf('Access-Token: %s', $this->accessToken));
        $this->resource->addHeader('Content-type: application/json');
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @method send
     * @return string
     */
    protected function send()
    {
        try {

            $return = $this->resource->exec();
            $this->response->setStatusCode((int)$return['http_code']);
            $this->response->setContentType($return['content_type']);
            $this->response->setContent($return['body']);

        } catch(ClientException $ex) {
            $this->handlerException($e);
        }

        return $this->response;
    }

    public function __get($name) 
    {
        try {
            
            $builder = new ContainerBuilder();
            $container = $builder->build();

            $class = sprintf('TotalVoice\Api\%s', ucwords($name));
            
            return $container->make($class, ['client' => $this]);

        } catch(NotFoundException $e) {
            throw new ClientException(sprintf('Não foi possível instanciar a classe: %s', $class));
        }
    }

    /**
     * @return void
     */
    public function handlerException(\Exception $ex)
    {
        $this->response->setStatusCode(500);
        $this->response->setContent(json_encode(['error' => $ex->getMessage()]));
    }
}