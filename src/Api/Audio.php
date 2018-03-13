<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Audio
{
    /**
     * @var string
     */
    const ROTA_AUDIO = '/audio/';

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
     * Envia um audio para um número destino
     * @param string $numeroDestino
     * @param string $urlAudio
     * @param bool $respostaUsuario
     * @param string $bina
     * @param bool $gravarAudio
     * @return mixed
     */
    public function enviar($numeroDestino, $urlAudio, $respostaUsuario = false, $bina = null, $gravarAudio = false)
    {
        return $this->client->post(
            new Route([self::ROTA_AUDIO]), [
                'numero_destino'   => $numeroDestino,
                'url_audio'        => $urlAudio,
                'resposta_usuario' => $respostaUsuario,
                'gravar_audio'     => $gravarAudio,
                'bina'             => $bina
        ]);
    }

    /**
     * Busca um audio pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaAudio($id)
    {
        return $this->client->get(new Route([self::ROTA_AUDIO, $id]));
    }

    /**
     * Relatório de mensagens de Audios
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @return mixed
     */
    public function relatorio(\DateTime $dataInicio, \DateTime $dataFinal)
    {
        $dataInicio->setTimezone(new \DateTimeZone('UTC'));
        $dataFinal->setTimezone(new \DateTimeZone('UTC'));
        return $this->client->get(
            new Route([self::ROTA_AUDIO, 'relatorio']), [
            'data_inicio' => $dataInicio->format('Y-m-d H:i:s e'),
            'data_fim'    => $dataFinal->format('Y-m-d H:i:s e')
        ]);
    }
}