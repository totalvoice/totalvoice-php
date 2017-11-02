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
     * @param string $numero_destino
     * @param string $mensagem
     * @param bool   $resposta_usuario
     * @param bool   $multi_sms
     * @return mixed
     */
    public function enviar($numero_destino, $mensagem, $resposta_usuario = false, $multi_sms = false)
    {
        return $this->client->post(
            new Route([self::ROTA_SMS]), [
                'numero_destino'    => $numero_destino,
                'mensagem'          => $mensagem,
                'resposta_usuario'  => $resposta_usuario,
                'multi_sms'         => $multi_sms
            ]
        );
    }

    /**
     * Busca um sms pelo seu ID
     * @param $id
     * @return string
     */
    public function buscaSms($id)
    {
        return $this->client->get(new Route([self::ROTA_SMS, $id]));
    }

    /**
     * Relatório de mensagens de Sms
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @return string
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