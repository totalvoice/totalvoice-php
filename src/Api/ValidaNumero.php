<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

class ValidaNumero extends ApiRelatorio
{
    /**
     * @var string
     */
    const ROTA_VALIDA_NUMERO = '/valida_numero/';

    /**
     * Envia uma chamada para validação do número
     * @param $numeroDestino
     * @param $gravarAudio
     * @param int $bina
     * @param bool $maxTentativas
     * @return string
     */ 
    public function enviar($numeroDestino, $gravarAudio= false, $bina = null, $maxTentativas = 1)
    {
        return $this->client->post(
            new Route([self::ROTA_VALIDA_NUMERO]), [
                'numero_destino' => $numeroDestino,
                'gravar_audio'   => $gravarAudio,
                'bina'        => $bina,
                'max_tentativas'            => $maxTentativas
            ]
        );
    }

    /**
     * Busca os dados da validação
     * @param int $id
     * @return mixed
     */
    public function buscar($id)
    {
        return $this->client->get(new Route([self::ROTA_VALIDA_NUMERO, $id]));
    }

    public function getRota()
    {
        return self::ROTA_VALIDA_NUMERO;
    }

    
}