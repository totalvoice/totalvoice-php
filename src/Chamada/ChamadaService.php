<?php
namespace TotalVoice\Chamada;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class ChamadaService
{
    /**
     * @var string
     */
    const ROTA_CHAMADA = '/chamada/';

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
     * Realiza uma chamada telefônica entre dois números: A e B
     * @param string $numeroOrigem
     * @param string $numeroDestino
     * @param bool $salvaAudio
     * @param string $binaOrigem
     * @param string $binaDestino
     * @param string $tags
     * @return mixed
     */
    public function ligar($numeroOrigem, $numeroDestino, $salvaAudio = false, $binaOrigem = null, $binaDestino = null, $tags = null)
    {
        return $this->client->post(
            new Route([self::ROTA_CHAMADA]), [
                'numero_origem'  => $numeroOrigem,
                'numero_destino' => $numeroDestino,
                'gravar_audio'   => $salvaAudio,
                'bina_origem'    => $binaOrigem,
                'bina_destino'   => $binaDestino,
                'tags'           => $tags
            ]
        );
    }

    /**
     * Encerra uma chamada ativa
     * @param $id
     * @return string
     */
    public function encerrar($id)
    {
        return $this->client->delete(new Route([self::ROTA_CHAMADA, $id]));
    }

    /**
     * Busca uma chamada pelo seu ID
     * @param $id
     * @return string
     */
    public function buscaChamada($id)
    {
        return $this->client->get(new Route([self::ROTA_CHAMADA, $id]));
    }

    /**
     * Download do áudio de uma chamada gravada
     * @param $id
     * @return string
     */
    public function downloadGravacao($id)
    {
        return $this->client->get(new Route([self::ROTA_CHAMADA, $id, '/gravacao']));
    }

    /**
     * Relatório de mensagens de Chamadas
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @return string
     */
    public function relatorio(\DateTime $dataInicio, \DateTime $dataFinal)
    {
        return $this->client->get(
            new Route([self::ROTA_CHAMADA, 'relatorio']), [
            'data_inicio' => $dataInicio->format('d/m/Y'),
            'data_fim'    => $dataFinal->format('d/m/Y')
        ]);
    }

    /**
     * (Beta) Escuta uma chamada ativa
     * @param $id
     * @param string $numero
     * @param string $modo
     * @return string
     */
    public function escutar($id, $numero, $modo)
    {
        return $this->client->get(
            new Route([self::ROTA_CHAMADA, $id, '/escuta']), [
            'numero' => $numero,
            'modo'   => $modo
        ]);
    }

    /**
     * (Beta) Faz uma transferência da chamada atual
     * @param int $id
     * @param string $numero
     * @param string $perna
     * @return string
     */
    public function transferir($id, $numero, $perna)
    {
        return $this->client->post(
            new Route([self::ROTA_CHAMADA, $id]), [
                'numero' => $number,
                'perna'  => $perna
            ]
        );
    }
}