<?php
namespace TotalVoice\MinhaConta;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class ContaService
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
     * @return string
     */
    public function consultaSaldo()
    {
        return $this->client->get(new Route([self::ROTA_SALDO]));
    }

    /**
     * Leitura dos dados da minha conta
     * @return string
     */
    public function minhaConta()
    {
        return $this->client->get(new Route([self::ROTA_CONTA]));
    }

    /**
     * Atualiza os dados da minha conta
     * @param string $name
     * @param string $login
     * @param string $password
     * @param null $cpfCnpj
     * @param null $phone
     * @return string
     */
    public function atualizaDadosConta($name, $login, $password, $cpfCnpj = null, $phone = null)
    {
        return $this->client->put(
            new Route([self::ROTA_CONTA]), [
                'nome'     => $name,
                'login'    => $login,
                'senha'    => $password,
                'cpf_cnpj' => $cpfCnpj,
                'telefone' => $phone
            ]            
        );
    }

    /**
     * Gera um relatório com as recargas efetuadas
     * @return string
     */
    public function relatorioRecarga()
    {
        return $this->client->get(new Route([self::ROTA_CONTA, 'recargas']));
    }

    /**
     * Gera uma URL para recarga de créditos
     * @return string
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
     * @return string
     */
    public function webhooks()
    {
        return $this->client->get(new Route([self::ROTA_WEBHOOK]));
    }

    /**
     * Apaga um webhook
     * @param string $name
     * @return string
     */
    public function excluirWebhook($name)
    {
        return $this->client->delete(new Route([self::ROTA_WEBHOOK, $name]));
    }

    /**
     * Cadastra ou atualiza um webhook
     * @param $name
     * @param $url
     * @return string
     */
    public function salvaWebhook($name, $url)
    {
        return $this->client->put(
            new Route([self::ROTA_WEBHOOK, $name]), 
            ['url' => $url]
        );
    }
}