<?php
namespace TotalVoice\Api;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class Verificacao
{
    /**
     * @var string
     */
    const ROTA_VERIFICACAO = '/verificacao/';

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
     * Envia o código de verificação para o número destino
     * @param $numeroDestino
     * @param $nomeProduto
     * @param int $tamanho
     * @param bool $isTTS
     * @return string
     */
    public function enviar($numeroDestino, $nomeProduto, $tamanho = 4, $isTTS = false)
    {
        return $this->client->post(
            new Route([self::ROTA_VERIFICACAO]), [
                'numero_destino' => $numeroDestino,
                'nome_produto'   => $nomeProduto,
                'tamanho'        => $tamanho,
                'tts'            => $isTTS
            ]
        );
    }

    /**
     * Busca os dados da verificacao
     * @param int $id
     * @param string $pin
     * @return mixed
     */
    public function buscar($id, $pin)
    {
        return $this->client->get(new Route([self::ROTA_VERIFICACAO]), [
            'id'  => $id,
            'pin' => $pin
        ]);
    }
}