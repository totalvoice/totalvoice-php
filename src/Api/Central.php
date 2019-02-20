<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

class Central extends ApiRelatorioChamadas
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
     * Recupera as informações de pausas do ramal
     * @param int $id
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @param array $filtros
     * @return mixed
     */
    public function relatorioPausasRamal($id, \DateTime $dataInicio, \DateTime $dataFinal, array $filtros = [])
    {
        $dataInicio->setTimezone(new \DateTimeZone('UTC'));
        $dataFinal->setTimezone(new \DateTimeZone('UTC'));
        return $this->client->get(
            new Route([self::ROTA_RAMAL, $id, '/pausas']), array_merge([
                'data_inicio' => $dataInicio->format('Y-m-d H:i:s e'),
                'data_fim'    => $dataFinal->format('Y-m-d H:i:s e')
            ], $filtros)
        );
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

    public function getRota()
    {
        return self::ROTA_RAMAL;
    }
}