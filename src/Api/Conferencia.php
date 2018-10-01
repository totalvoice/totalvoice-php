<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

class Conferencia extends ApiRelatorio
{
    /**
     * @var string
     */
    const ROTA_CONFERENCIA = '/conferencia/';

    /**
     * Cria uma conferência
     * @return mixed
     */
    public function criaConferencia()
    {
        return $this->client->post(new Route([self::ROTA_CONFERENCIA]), []);
    }

    /**
     * Busca uma conferência pelo seu ID
     * @param $id
     * @param array $filtros
     * @return mixed
     */
    public function buscaConferencia($id, $filtros = [])
    {
        return $this->client->get(new Route([self::ROTA_CONFERENCIA, $id]), $filtros);
    }

    /**
     * Envia um audio para um número destino
     * @param int $id
     * @param string $numero
     * @param string bina
     * @param bool $gravarAudio
     * @return mixed
     */
    public function addNumeroConferencia($id, $numero, $bina = null, $gravarAudio = false)
    {
        return $this->client->post(
            new Route([self::ROTA_CONFERENCIA, $id]), [
                'numero'       => $numero,
                'bina'         => $bina,
                'gravar_audio' => $gravarAudio
            ]
        );
    }

        /**
     * Remove uma conferência ativa
     * @param  string $id
     * @return mixed
     */
    public function excluir($id)
    {
        return $this->client->delete(new Route([self::ROTA_CONFERENCIA, $id]));
    }

    /**
     * Relatório de itens com filtros
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @param array $filtros
     * @return mixed
     */
    public function relatorioChamadasConferencia(\DateTime $dataInicio, \DateTime $dataFinal, array $filtros = [])
    {
        $dataInicio->setTimezone(new \DateTimeZone('UTC'));
        $dataFinal->setTimezone(new \DateTimeZone('UTC'));
        return $this->client->get(
            new Route([self::ROTA_CONFERENCIA, 'chamadas/', 'relatorio']), array_merge([
            'data_inicio' => $dataInicio->format('Y-m-d H:i:s e'),
            'data_fim'    => $dataFinal->format('Y-m-d H:i:s e')
        ], $filtros));
    }

    /**
     * @return string
     */
    public function getRota()
    {
        return self::ROTA_CONFERENCIA;
    }
}