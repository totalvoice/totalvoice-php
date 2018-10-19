<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

class Status extends Api
{
    /**
     * @var string
     */
    const ROTA_STATUS = '/status/';

    /**
     * Verifica o status da API
     * @return string
     */
    public function verificar()
    {
        return $this->client->get(new Route([$this->getRota()]));
    }

    /**
     * Consulta o status de um serviço
     * @param $nome
     * @return string
     */
    public function consultar($nome)
    {
        return $this->client->get(new Route([$this->getRota(), $nome]));
    }

    /**
     * @return string
     */
    public function getRota()
    {
        return self::ROTA_STATUS;
    }
}
