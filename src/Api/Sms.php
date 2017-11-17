<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Sms
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
     * @param string $numeroDestino
     * @param string $mensagem
     * @param boolean $respostaUsuario
     * @param boolean $multiSMS
     * @return mixed
     */
    public function enviar($numeroDestino, $mensagem, $respostaUsuario = false, $multiSMS = false)
    {
        return $this->client->post(
            new Route([self::ROTA_SMS]), [
                'numero_destino'  => $numeroDestino,
                'mensagem'        => $mensagem,
                'resposta_usuario'=> $respostaUsuario,
                'multi_sms'       => $multiSMS
            ]
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
        $dataInicio->setTimezone(new \DateTimeZone('UTC'));
        $dataFinal->setTimezone(new \DateTimeZone('UTC'));
        return $this->client->get(
            new Route([self::ROTA_SMS, 'relatorio']), [
            'data_inicio' => $dataInicio->format('Y-m-d H:i:s e'),
            'data_fim'    => $dataFinal->format('Y-m-d H:i:s e')
        ]);
    }
}