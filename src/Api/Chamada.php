<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Chamada
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
     * @param array $opcoes
     * @return mixed
     */
    public function ligar($numeroOrigem, $numeroDestino, $opcoes = [])
    {
        $req = [
            'numero_origem'  => $numeroOrigem,
            'numero_destino' => $numeroDestino
        ];
        $data = array_merge($req, $opcoes);
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
     * @param string $numero
     * @param int $modo
     * @return mixed
     */
    public function escutar($id, $numero, $modo)
    {
        return $this->client->get(
            new Route([self::ROTA_CHAMADA, $id, '/escuta']), [
                'numero' => $numero,
                'modo'   => $modo
            ]            
        );
    }

    /**
     * (Beta) Faz uma transferência da chamada atual
     * @param int $id
     * @param string $numero
     * @param string $perna
     * @return mixed
     */
    public function transferir($id, $numero, $perna)
    {
        return $this->client->post(
            new Route([self::ROTA_CHAMADA, $id]), [
                'numero' => $numero,
                'perna'  => $perna
            ]            
        );
    }

    /**
     * Avalia uma Chamada com nota de 1 a 5
     * @param int $id
     * @param string $nota
     * @param string $comentario
     * @return mixed
     */
    public function avaliar($id, $nota, $comentario = null)
    {
        return $this->client->post(
            new Route([self::ROTA_CHAMADA, $id]), [
                'nota'       => $nota,
                'comentario' => $comentario
            ]            
        );
    }
}