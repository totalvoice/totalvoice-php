<?php
namespace TotalVoice\Conta;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class GerenciadorContaService
{
    /**
     * @var string
     */
    const ROTA_CONTA = '/conta/';

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
     * @param string $name
     * @param string $login
     * @param string $password
     * @param null $cpfCnpj
     * @param null $phone
     * @return string
     */
    public function criar($name, $login, $password, $cpfCnpj = null, $phone = null)
    {
        return $this->client->post(
            new Route([self::ROTA_CONTA]), [
            'nome' => $name,
            'login' => $login,
            'senha' => $password,
            'cpf_cnpj' => $cpfCnpj,
            'telefone' => $phone
        ]);
    }

    /**
     * Leitura dos dados de uma conta criada
     * @return string
     */
    public function get($id)
    {
        return $this->client->get(new Route([self::ROTA_CONTA, $id]));
    }

    /**
     * Remove uma conta
     * @param $id
     * @return string
     */
    public function excluir($id)
    {
        return $this->client->delete(new Route([self::ROTA_CONTA, $id]));
    }

    /**
     * Atualiza os dados de uma conta criada
     * @return string
     */
    public function atualizar($id, $name, $login, $password, $cpfCnpj = null, $phone = null)
    {
        return $this->client->put(
            new Route([self::ROTA_CONTA, $id]), [
                'nome'     => $name,
                'login'    => $login,
                'senha'    => $password,
                'cpf_cnpj' => $cpfCnpj,
                'telefone' => $phone
            ]
        );
    }

    /**
     * Lista contas criadas por mim
     * @return string
     */
    public function relatorio()
    {
        return $this->client->get(new Route([self::ROTA_CONTA, 'relatorio']));
    }
}