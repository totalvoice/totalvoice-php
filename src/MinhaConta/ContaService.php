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
     * @param string $nome
     * @param string $login
     * @param string $senha
     * @param null $cpfCnpj
     * @param null $telefone
     * @return string
     */
    public function atualizaDadosConta($nome, $login, $senha, $cpfCnpj = null, $telefone = null)
    {
        return $this->client->put(
            new Route([self::ROTA_CONTA]), [
                'nome'     => $nome,
                'login'    => $login,
                'senha'    => $senha,
                'cpf_cnpj' => $cpfCnpj,
                'telefone' => $telefone
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
     * @param string $nome
     * @return string
     */
    public function excluirWebhook($nome)
    {
        return $this->client->delete(new Route([self::ROTA_WEBHOOK, $nome]));
    }

    /**
     * Cadastra ou atualiza um webhook
     * @param $nome
     * @param $url
     * @return string
     */
    public function salvaWebhook($nome, $url)
    {
        return $this->client->put(
            new Route([self::ROTA_WEBHOOK, $nome]), 
            ['url' => $url]
        );
    }
}