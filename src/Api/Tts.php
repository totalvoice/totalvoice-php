<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Tts
{
    /**
     * @var string
     */
    const ROTA_TTS = '/tts/';

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
     * Envia um TTS (text-to-speach) para um número destino
     * @param string $numeroDestino
     * @param string $mensagem
     * @param array $opcoes
     * @return mixed
     */
    public function enviar($numeroDestino, $mensagem, $opcoes)
    {
        $req = [
            'numero_destino' => $numeroDestino,
            'mensagem'       => $mensagem
        ];
        $data = array_merge($req, $opcoes);
        return $this->client->post(
            new Route([self::ROTA_TTS]),
            $data
        );
    }

    /**
     * Busca um tts pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaTts($id)
    {
        return $this->client->get(new Route([self::ROTA_TTS, $id]));
    }

    /**
     * Relatório de mensagens de Tts
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @return mixed
     */
    public function relatorio(\DateTime $dataInicio, \DateTime $dataFinal)
    {
        return $this->client->get(
            new Route([self::ROTA_TTS, 'relatorio']), [
            'data_inicio' => $dataInicio->format('d/m/Y'),
            'data_fim'    => $dataFinal->format('d/m/Y')
        ]);
    }
}