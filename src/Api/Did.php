<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Did
{
    /**
     * @var string
     */
    const ROTA_DID = '/did';

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
    public function lista()
    {
        return $this->client->get(new Route([self::ROTA_DID]));
    }

    /**
     * Remove um did
     * @param  string $id
     * @return mixed
     */
    public function excluir($id)
    {
        return $this->client->delete(new Route([self::ROTA_DID, $id]));
    }

    /**
     * Atualiza um did
     * @param string $id
     * @param string $ramal_id
     * @param string $ura_id
     * @return mixed
     */
    public function atualizar($id, $ramal_id=null, $ura_id=null)
    {
        $data = [
            'ramal_id'  => $ramal_id,
            'ura_id' => $ura_id
        ];
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
     * @param integer $id
     * @return mixed
     */
    public function adquirir($id)
    {
        return $this->client->post(
            new Route([self::ROTA_DID_ESTOQUE, $id])
        );
    }
}