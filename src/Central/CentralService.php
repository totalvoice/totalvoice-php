<?php
namespace TotalVoice\Central;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class CentralService
{
    /**
     * @var string
     */
    const ROTA_RAMAL = '/ramal/';

    /**
     * @var string
     */
    const ROTA_WEBPHONE = '/webphone/';

    /**
     * @var string
     */
    const ROTA_URA = '/ura/';

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
     * Cria um novo ramal
     * @param array $data
     * @return mixed
     */
    public function criarRamal($data)
    {
        return $this->client->post(
            new Route([self::ROTA_RAMAL]),
            $data
        );
    }

    /**
     * Remove um Ramal
     * @param  string $id
     * @return mixed
     */
    public function excluirRamal($id)
    {
        return $this->client->delete(new Route([self::ROTA_RAMAL, $id]));
    }

    /**
     * Busca uma Ramal pelo seu ID
     * @return mixed
     */
    public function buscaRamal($id)
    {
        return $this->client->get(new Route([self::ROTA_RAMAL, $id]));
    }

    /**
     * Atualiza um ramal
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function atualizarRamal($id, $data)
    {
        return $this->client->put(
            new Route([self::ROTA_RAMAL, $id]),
            $data
        );
    }

    /**
     * Relatório de mensagens de Ramal
     * @return mixed
     */
    public function relatorio()
    {
        return $this->client->get(new Route([self::ROTA_RAMAL, 'relatorio']));
    }

    /**
     * Requisita a URL do webphone de um ramal
     * @param array $data
     * @return mixed
     */
    public function webphone($data)
    {
        return $this->client->get(
            new Route([self::ROTA_WEBPHONE]),
            $data
        );
    }

    /**
     * Cria uma nova URA
     * @param string $nome
     * @param array $dados
     * @return mixed
     */
    public function criarUra($nome, $dados)
    {
        return $this->client->post(
            new Route([self::ROTA_URA]), [
            'nome'  => $nome,
            'dados' => $dados
        ]);
    }

    /**
     * Remove uma Ura
     * @param  string $id
     * @return mixed
     */
    public function excluirUra($id)
    {
        return $this->client->delete(new Route([self::ROTA_URA, $id]));
    }

    /**
     * Atualiza uma ura
     * @param string $id
     * @param string $nome
     * @param array $dados
     * @return mixed
     */
    public function atualizarUra($id, $nome, $dados)
    {
        return $this->client->put(
            new Route([self::ROTA_URA, $id]), [
                'nome'  => $nome,
                'dados' => $dados
            ]
        );
    }
}