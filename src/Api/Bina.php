<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

class Bina extends ApiRelatorio
{
    /**
     * @var string
     */
    const ROTA_BINA = '/bina/';

    /**
     * @param $telefone
     * @return string
     */
    public function enviar($telefone)
    {
        return $this->client->post(
            new Route([self::ROTA_BINA]), [
                'telefone' => $telefone
            ]
        );
    }

    /**
     * @param $codigo
     * @param $telefone
     * @return string
     */
    public function validar($codigo, $telefone)
    {
        return $this->client->get(
            new Route([self::ROTA_BINA]), [
                'codigo'   => $codigo,
                'telefone' => $telefone
            ]
        );
    }

    /**
     * @param $telefone
     * @return string
     */
    public function excluir($telefone)
    {
        return $this->client->delete(new Route([self::ROTA_BINA, $telefone]));
    }

    public function getRota()
    {
        return self::ROTA_BINA;
    }
}