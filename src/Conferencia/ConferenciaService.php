<?php
namespace TotalVoice\Conferencia;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class ConferenciaService
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
        return $this->client->post(
            new Route([self::ROTA_CONFERENCIA]), []);
    }

    /**
     * Busca uma conferência pelo seu ID
     * @param $id
     * @return string
     */
    public function buscaConferencia($id)
    {
        return $this->client->get(new Route([self::ROTA_CONFERENCIA, $id]));
    }

    /**
     * Envia um audio para um número destino
     * @param string $id
     * @param string $numero
     * @param string $bina
     * @param bool   $gravar_audio
     * @return mixed
     */
    public function addNumeroConferencia($id, $numero, $bina = null, $gravar_audio = false)
    {
        return $this->client->post(
            new Route([self::ROTA_CONFERENCIA, $id]), [
                'numero'        => $numero,
                'bina'          => $bina,
                'gravar_audio'  => $gravar_audio
            ]
        );
    }

}