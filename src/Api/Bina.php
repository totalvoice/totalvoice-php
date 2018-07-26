<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Bina
{
    /**
     * @var string
     */
    const ROTA_BINA = '/bina/';

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
     * @param $telefone
     * @return string
     */
    public function enviar($telefone)
    {
        return $this->client->post(
            new Route([self::ROTA_BINA]), [
                'telefone' => $telefone
            ]
        );
    }

    /**
     * @param $codigo
     * @param $telefone
     * @return string
     */
    public function validar($codigo, $telefone)
    {
        return $this->client->get(
            new Route([self::ROTA_BINA]), [
                'codigo'   => $codigo,
                'telefone' => $telefone
            ]
        );
    }

    /**
     * @param $telefone
     * @return string
     */
    public function excluir($telefone)
    {
        return $this->client->delete(new Route([self::ROTA_BINA, $telefone]));
    }

    /**
     * @return string
     */
    public function relatorio()
    {
        return $this->client->get(new Route([self::ROTA_BINA, 'relatorio']));
    }
}