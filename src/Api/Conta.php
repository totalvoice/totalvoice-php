<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Conta
{
    /**
     * @var string
     */
    const ROTA_CONTA = '/conta/';

    /**
     * @var string
     */
    const ROTA_WEBHOOK_DEFAULT = '/webhook-default/';

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
     * Cria uma nova conta na plataforma
     * @param array $data
     * @return mixed
     */
    public function criar($data)
    {
        return $this->client->post(
            new Route([self::ROTA_CONTA]),
            $data
        );
    }

    /**
     * Leitura dos dados de uma conta criada
     * @return mixed
     */
    public function buscaConta($id)
    {
        return $this->client->get(new Route([self::ROTA_CONTA, $id]));
    }

    /**
     * Remove uma conta
     * @param $id
     * @return mixed
     */
    public function excluir($id)
    {
        return $this->client->delete(new Route([self::ROTA_CONTA, $id]));
    }

    /**
     * Atualiza os dados de uma conta criada
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function atualizar($id, $data)
    {
        return $this->client->put(
            new Route([self::ROTA_CONTA, $id]),
            $data
        );
    }

    /**
     * Lista contas criadas por mim
     * @return mixed
     */
    public function relatorio()
    {
        return $this->client->get(new Route([self::ROTA_CONTA, 'relatorio']));
    }

    /**
     * Credita valor de bônus em uma conta filha
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function recargaBonus($id, $data)
    {
        return $this->client->post(
            new Route([self::ROTA_CONTA, $id, '/bonus']),
            $data
        );
    }

        /**
     * Retorna a lista de webhooks default configurados para esta conta
     * @return mixed
     */
    public function webhooksDefault()
    {
        return $this->client->get(new Route([self::ROTA_CONTA, self::ROTA_WEBHOOK_DEFAULT]));
    }

    /**
     * Apaga um webhook default
     * @param string $nome
     * @return mixed
     */
    public function excluirWebhookDefault($nome)
    {   
        return $this->client->delete(new Route([self::ROTA_CONTA, self::ROTA_WEBHOOK_DEFAULT, $nome]));
    }

    /**
     * Cadastra ou atualiza um webhook default
     * @param $nome
     * @param $url
     * @return mixed
     */
    public function salvaWebhookDefault($nome, $url)
    {
        return $this->client->put(
            new Route([self::ROTA_CONTA, self::ROTA_WEBHOOK_DEFAULT, $nome]), 
            ['url' => $url]
        );
    }
}