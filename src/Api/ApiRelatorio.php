<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

abstract class ApiRelatorio extends Api
{
    /**
     * Relatório de itens com filtros
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @param array $filtros
     * @return mixed
     */
    public function relatorio(\DateTime $dataInicio, \DateTime $dataFinal, array $filtros = [])
    {
        $dataInicio->setTimezone(new \DateTimeZone('UTC'));
        $dataFinal->setTimezone(new \DateTimeZone('UTC'));
        return $this->client->get(
            new Route([$this->getRota(), 'relatorio']), array_merge([
            'data_inicio' => $dataInicio->format('Y-m-d H:i:s e'),
            'data_fim'    => $dataFinal->format('Y-m-d H:i:s e')
        ], $filtros));
    }
}