<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Did
{
    /**
     * @var string
     */
    const ROTA_DID = '/did/';

    /**
     * @var string
     */
    const ROTA_DID_ESTOQUE = '/did/estoque';
    
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
     * Lista todos os dids pertencentes
     * @return mixed
     */
    public function listaDids()
    {
        return $this->client->get(new Route([self::ROTA_DID]));
    }

    /**
     * Remove um did
     * @param  string $id
     * @return mixed
     */
    public function excluirDid($id)
    {
        return $this->client->delete(new Route([self::ROTA_DID, $id]));
    }

    /**
     * Atualiza um did
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function atualizarDid($id, $data)
    {
        return $this->client->put(
            new Route([self::ROTA_DID, $id]),
            $data
        );
    }

    /**
     * Lista todos os dids disponiveis
     * @return mixed
     */
    public function listaEstoque()
    {
        return $this->client->get(new Route([self::ROTA_DID_ESTOQUE]));
    }

    /**
     * Adquire um novo did para sua conta
     * @param array $data
     * @return mixed
     */
    public function criar($data)
    {
        return $this->client->post(
            new Route([self::ROTA_DID_ESTOQUE]),
            $data
        );
    }
}