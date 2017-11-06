<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Conferencia
{
    /**
     * @var string
     */
    const ROTA_CONFERENCIA = '/conferencia/';

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
     * Cria uma conferência
     * @return mixed
     */
    public function criaConferencia()
    {
        return $this->client->post(new Route([self::ROTA_CONFERENCIA]), []);
    }

    /**
     * Busca uma conferência pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaConferencia($id)
    {
        return $this->client->get(new Route([self::ROTA_CONFERENCIA, $id]));
    }

    /**
     * Envia um audio para um número destino
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function addNumeroConferencia($id, $numero, $bina = null, $gravarAudio = false)
    {
        return $this->client->post(
            new Route([self::ROTA_CONFERENCIA, $id]), [
                'numero'       => $numero,
                'bina'         => $bina,
                'gravar_audio' => $gravarAudio
            ]
        );
    }
}