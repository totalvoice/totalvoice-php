<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Composto
{
    /**
     * @var string
     */
    const ROTA_COMPOSTO = '/composo/';

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
     * Envia um composto para um número destino
     * @param string $numeroDestino
     * @param array $dados
     * @param string $bina
     * @param string $tags
     * @return mixed
     */
    public function enviar($numeroDestino, array $dados, $bina = null, $tags = null)
    {
        return $this->client->post(
            new Route([self::ROTA_COMPOSTO]), [
                'numero_destino' => $numeroDestino,
                'dados'          => $dados,
                'bina'           => $bina,
                'tags'           => $tags
            ]
        );
    }

    /**
     * Busca um composto pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaComposto($id)
    {
        return $this->client->get(new Route([self::ROTA_COMPOSTO, $id]));
    }

    /**
     * Relatório de mensagens de Composto
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @return mixed
     */
    public function relatorio(\DateTime $dataInicio, \DateTime $dataFinal)
    {
        return $this->client->get(
            new Route([self::ROTA_COMPOSTO, 'relatorio']), [
            'data_inicio' => $dataInicio->format('d/m/Y'),
            'data_fim'    => $dataFinal->format('d/m/Y')
        ]);
    }
}