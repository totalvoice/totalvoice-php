<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

class Composto extends ApiRelatorio
{
    /**
     * @var string
     */
    const ROTA_COMPOSTO = '/composto/';

    /**
     * Envia um composto para um número destino
     * @param string $numeroDestino
     * @param array $dados
     * @param string $bina
     * @param string $tags
     * @return mixed
     */
    public function enviar($numeroDestino, array $dados, $bina = null, $tags = null, $gravar_audio = false, $detecta_caixa = false)
    {
        return $this->client->post(
            new Route([self::ROTA_COMPOSTO]), [
                'numero_destino' => $numeroDestino,
                'dados'          => $dados,
                'bina'           => $bina,
                'tags'           => $tags,
                'gravar_audio'   => $gravar_audio,
                'detecta_caixa'  => $detecta_caixa
            ]
        );
    }

    /**
     * Busca um composto pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaComposto($id)
    {
        return $this->client->get(new Route([self::ROTA_COMPOSTO, $id]));
    }

    public function getRota()
    {
        return self::ROTA_COMPOSTO;
    }
}