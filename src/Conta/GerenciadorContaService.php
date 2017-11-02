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
     * @param string $nome
     * @param string $login
     * @param string $senha
     * @param null $cpfCnpj
     * @param null $telefone
     * @return string
     */
    public function criar($nome, $login, $senha, $cpfCnpj = null, $telefone = null)
    {
        return $this->client->post(
            new Route([self::ROTA_CONTA]), [
            'nome'     => $nome,
            'login'    => $login,
            'senha'    => $senha,
            'cpf_cnpj' => $cpfCnpj,
            'telefone' => $telefone
        ]);
    }

    /**
     * Leitura dos dados de uma conta criada
     * @return string
     */
    public function buscaConta($id)
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
    public function atualizar($id, $nome, $login, $senha, $cpfCnpj = null, $telefone = null)
    {
        return $this->client->put(
            new Route([self::ROTA_CONTA, $id]), [
                'nome'     => $nome,
                'login'    => $login,
                'senha'    => $senha,
                'cpf_cnpj' => $cpfCnpj,
                'telefone' => $telefone
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