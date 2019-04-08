<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

class Audio extends ApiRelatorio
{
    /**
     * @var string
     */
    const ROTA_AUDIO = '/audio/';

    /**
     * Envia um audio para um número destino
     * @param string $numeroDestino
     * @param string $urlAudio
     * @param bool $respostaUsuario
     * @param string $bina
     * @param bool $gravarAudio
     * @param bool $detectaCaixa
     * @return mixed
     */
    public function enviar($numeroDestino, $urlAudio, $respostaUsuario = false, $bina = null, $gravarAudio = false, $detectaCaixa = false)
    {
        return $this->client->post(
            new Route([self::ROTA_AUDIO]), [
                'numero_destino'   => $numeroDestino,
                'url_audio'        => $urlAudio,
                'resposta_usuario' => $respostaUsuario,
                'gravar_audio'     => $gravarAudio,
                'bina'             => $bina,
                'detecta_caixa'     => $detectaCaixa
        ]);
    }

    /**
     * Busca um audio pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaAudio($id)
    {
        return $this->client->get(new Route([self::ROTA_AUDIO, $id]));
    }

    public function getRota()
    {
        return self::ROTA_AUDIO;
    }
}