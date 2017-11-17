<?php
namespace TotalVoice;

use TotalVoice\Handler\Curl;
use TotalVoice\Handler\Http;
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
    const NAMESPACE_API = 'TotalVoice\\Api\\';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $baseUri;

    /**
     * Client constructor.
     * @param $accessToken
     * @param $baseUri
     */
    public function __construct($accessToken, $baseUri = self::BASE_URI)
    {
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
     * @return Curl
     */
    public function buildRequest(RouteInterface $route, $method, $params = [], $data = [])
    {
        $resource = new Curl();
        $query = $this->query($params);
        $resource->addHeader(sprintf('Access-Token: %s', $this->accessToken));
        $resource->addHeader('Content-type: application/json');
        $resource->setMethod($method);
        $url = sprintf('%s%s%s', $this->baseUri, $route->build(), $query);
        $resource->setUrl($url);
        if(! empty($data)) {
            $resource->setBody($data);;
        }

        return $resource;
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
     * @return mixed
     */
    public function __get($name) 
    {
        try {
            $builder = new ContainerBuilder();
            $container = $builder->build();

            $class = static::NAMESPACE_API . ucwords($name);
            return $container->make($class, ['client' => $this]);

        } catch(NotFoundException $e) {
            throw new ClientException(sprintf('Não foi possível instanciar a classe: %s', $class));
        }
    }
}