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
     * @param array $data
     * @return mixed
     */
    public function ligar($data)
    {
        return $this->client->post(
            new Route([self::ROTA_CHAMADA]),
            $data
        );
    }

    /**
     * Encerra uma chamada ativa
     * @param $id
     * @return mixed
     */
    public function encerrar($id)
    {
        return $this->client->delete(new Route([self::ROTA_CHAMADA, $id]));
    }

    /**
     * Busca uma chamada pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaChamada($id)
    {
        return $this->client->get(new Route([self::ROTA_CHAMADA, $id]));
    }

    /**
     * Download do áudio de uma chamada gravada
     * @param $id
     * @return mixed
     */
    public function downloadGravacao($id)
    {
        return $this->client->get(new Route([self::ROTA_CHAMADA, $id, '/gravacao']));
    }

    /**
     * Relatório de mensagens de Chamadas
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @return mixed
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
     * @param array $data
     * @return mixed
     */
    public function escutar($id, $data)
    {
        return $this->client->get(
            new Route([self::ROTA_CHAMADA, $id, '/escuta']),
            $data
        );
    }

    /**
     * (Beta) Faz uma transferência da chamada atual
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function transferir($id, $data)
    {
        return $this->client->post(
            new Route([self::ROTA_CHAMADA, $id]),
            $data
        );
    }
}