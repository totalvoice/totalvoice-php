<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

class Fila extends ApiRelatorioChamadas
{
    /**
     * @var string
     */
    const ROTA_FILA = '/fila/';

    /**
     * Lista as filas em sua Conta
     * @return string
     */
    public function listar()
    {
        return $this->client->get(new Route([self::ROTA_FILA]));
    }

    /**
     * @param int $id
     * @return string
     */
    public function buscar($id)
    {
        return $this->client->get(new Route([self::ROTA_FILA, $id]));
    }

    /**
     * Cria uma nova fila
     * @param string $nome
     * @param string $estrategia_ring
     * @param array $timeout_ring
     * @return mixed
     */
    public function criar($nome, $estrategia_ring, $timeout_ring = null)
    {
        $req = [
            'nome'              => $nome,
            'estrategia_ring'   => $estrategia_ring,
            'timeout_ring'      => $timeout_ring
        ];
        return $this->client->post(
            new Route([self::ROTA_FILA]),
            $req
        );
    }


    /**
     * Adiciona um ramal na fila
     * @param string $id
     * @param string $ramal_id
     * @return mixed
     */
    public function addRamal($id, $ramal_id)
    {
        $req = [
            'ramal_id'  => $ramal_id,
        ];
        return $this->client->post(
            new Route([self::ROTA_FILA, $id]),
            $req
        );
    }

    /**
     * Atualiza uma fila
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function atualizarFila($id, $data)
    {
        return $this->client->put(
            new Route([self::ROTA_FILA, $id]),
            $data
        );
    }

    /**
     * Remove um ramal da fila
     * @param  string $id
     * @param  string $ramal_id
     * @return mixed
     */
    public function excluirRamalFila($id, $ramal_id)
    {
        return $this->client->delete(new Route([self::ROTA_RAMAL, $id.'/', $ramal_id ]));
    }

    /**
     * @param int $id
     * @param  string $ramal_id
     * @return string
     */
    public function buscarFilaRamal($id, $ramal_id)
    {
        return $this->client->get(new Route([self::ROTA_RAMAL, $id.'/', $ramal_id ]));
    }


    public function getRota()
    {
        return self::ROTA_FILA;
    }
}