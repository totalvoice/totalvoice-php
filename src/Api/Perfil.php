<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Perfil
{
    /**
     * @var string
     */
    const ROTA_CONTA = '/conta/';

    /**
     * @var string
     */
    const ROTA_WEBHOOK = '/webhook/';

    /**
     * @var string
     */
    const ROTA_SALDO = '/saldo/';

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
     * Consulta saldo atual
     * @return mixed
     */
    public function consultaSaldo()
    {
        return $this->client->get(new Route([self::ROTA_SALDO]));
    }

    /**
     * Leitura dos dados da minha conta
     * @return mixed
     */
    public function minhaConta()
    {
        return $this->client->get(new Route([self::ROTA_CONTA]));
    }

    /**
     * Atualiza os dados da minha conta
     * @param array $data
     * @return mixed
     */
    public function atualizaDadosConta($data)
    {
        return $this->client->put(
            new Route([self::ROTA_CONTA]),
            $data
        );
    }

    /**
     * Gera um relatório com as recargas efetuadas
     * @return mixed
     */
    public function relatorioRecarga()
    {
        return $this->client->get(new Route([self::ROTA_CONTA, 'recargas']));
    }

    /**
     * Gera uma URL para recarga de créditos
     * @return mixed
     */
    public function urlRecarga($returnUrl)
    {
        return $this->client->get(
            new Route([self::ROTA_CONTA, 'urlrecarga']), 
            ['url_retorno' => $returnUrl]
        );
    }

    /**
     * Retorna a lista de webhooks configurados para esta conta
     * @return mixed
     */
    public function webhooks()
    {
        return $this->client->get(new Route([self::ROTA_WEBHOOK]));
    }

    /**
     * Apaga um webhook
     * @param string $nome
     * @return mixed
     */
    public function excluirWebhook($nome)
    {
        return $this->client->delete(new Route([self::ROTA_WEBHOOK, $nome]));
    }

    /**
     * Cadastra ou atualiza um webhook
     * @param $nome
     * @param $url
     * @return mixed
     */
    public function salvaWebhook($nome, $url)
    {
        return $this->client->put(
            new Route([self::ROTA_WEBHOOK, $nome]), 
            ['url' => $url]
        );
    }
}