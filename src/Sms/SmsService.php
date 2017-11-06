<?php
namespace TotalVoice\Sms;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class SmsService
{
    /**
     * @var string
     */
    const ROTA_SMS = '/sms/';

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
     * Envia um sms para um número destino
     * @param array $data
     * @return mixed
     */
    public function enviar($data)
    {
        return $this->client->post(
            new Route([self::ROTA_SMS]),
            $data
        );
    }

    /**
     * Busca um sms pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaSms($id)
    {
        return $this->client->get(new Route([self::ROTA_SMS, $id]));
    }

    /**
     * Relatório de mensagens de Sms
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @return mixed
     */
    public function relatorio(\DateTime $dataInicio, \DateTime $dataFinal)
    {
        return $this->client->get(
            new Route([self::ROTA_SMS, 'relatorio']), [
            'data_inicio' => $dataInicio->format('d/m/Y'),
            'data_fim'    => $dataFinal->format('d/m/Y')
        ]);
    }
}