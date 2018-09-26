<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

class Tts extends ApiRelatorio
{
    /**
     * @var string
     */
    const ROTA_TTS = '/tts/';

    /**
     * Envia um TTS (text-to-speach) para um número destino
     * @param string $numeroDestino
     * @param string $mensagem
     * @param array $opcoes
     * @return mixed
     */
    public function enviar($numeroDestino, $mensagem, $opcoes = [])
    {
        $req = [
            'numero_destino' => $numeroDestino,
            'mensagem'       => $mensagem
        ];
        $data = array_merge($req, $opcoes);
        return $this->client->post(
            new Route([self::ROTA_TTS]),
            $data
        );
    }

    /**
     * Busca um tts pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaTts($id)
    {
        return $this->client->get(new Route([self::ROTA_TTS, $id]));
    }

    public function getRota()
    {
        return self::ROTA_TTS;
    }
}