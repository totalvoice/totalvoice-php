<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Fila
{
    /**
     * @var string
     */
    const ROTA_FILA = '/fila/';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Service constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $id
     * @return string
     */
    public function buscar($id)
    {
        return $this->client->get(new Route([self::ROTA_FILA, $id]));
    }
}