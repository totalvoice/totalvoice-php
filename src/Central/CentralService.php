<?php
namespace TotalVoice\Central;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class CentralService
{
    /**
     * @var string
     */
    const ROTA_RAMAL = '/ramal/';

    /**
     * @var string
     */
    const ROTA_WEBPHONE = '/webphone/';

    /**
     * @var string
     */
    const ROTA_URA = '/ura/';

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
     * Cria um novo ramal
     * @return string
     */
    public function criarRamal(
        $ramal = null, 
        $login = null, 
        $senha = null, 
        $bina = null, 
        $isLigacaoExterna = false, 
        $isLigacaoCelular = false, 
        $isSalvaAudio = false, 
        $isAcessoGravacao = false,
        $uraId = null,
        $isVoicemail = false
    )
    {
        return $this->client->post(
            new Route([self::ROTA_RAMAL]), [
            'ramal'           => $ramal,
            'login'           => $login,
            'senha'           => $senha,
            'bina'            => $bina,
            'ligacao_externa' => $isLigacaoExterna,
            'ligacao_celular' => $isLigacaoCelular,
            'gravar_audio'    => $isSalvaAudio,
            'acesso_gravacoes'=> $isAcessoGravacao,
            'ura_id'          => $uraId,
            'voicemail'       => $isVoicemail,
        ]);
    }

    /**
     * Remove um Ramal
     * @param  string $id
     * @return string
     */
    public function excluirRamal($id)
    {
        return $this->client->delete(new Route([self::ROTA_RAMAL, $id]));
    }

    /**
     * Busca uma Ramal pelo seu ID
     * @return string
     */
    public function buscaRamal($id)
    {
        return $this->client->get(new Route([self::ROTA_RAMAL, $id]));
    }

    /**
     * Atualiza um ramal
     * @return string
     */
    public function atualizarRamal(
        $id, 
        $ramal = null, 
        $login = null, 
        $senha = null, 
        $bina = null, 
        $isLigacaoExterna = false, 
        $isLigacaoCelular = false, 
        $isSalvaAudio = false, 
        $isAcessoGravacao = false,
        $uraId = null,
        $isVoicemail = false
    )
    {
        return $this->client->put(
            new Route([self::ROTA_RAMAL, $id]), [
                'ramal'           => $ramal,
                'login'           => $login,
                'senha'           => $senha,
                'bina'            => $bina,
                'ligacao_externa' => $isLigacaoExterna,
                'ligacao_celular' => $isLigacaoCelular,
                'gravar_audio'    => $isSalvaAudio,
                'acesso_gravacoes'=> $isAcessoGravacao,
                'ura_id'          => $uraId,
                'voicemail'       => $isVoicemail,
            ]
        );
    }

    /**
     * Relatório de mensagens de Ramal
     * @return string
     */
    public function relatorio()
    {
        return $this->client->get(new Route([self::ROTA_RAMAL, 'relatorio']));
    }

    /**
     * Requisita a URL do webphone de um ramal
     * @param $tipo
     * @param $idRamal
     * @param $ramal
     * @param $ligarPara
     * @param $fecharFim
     * @return string
     */
    public function webphone($tipo, $idRamal, $ramal, $ligarPara, $fecharFim)
    {
        return $this->client->get(
            new Route([self::ROTA_WEBPHONE]), [
                'tipo'       => $tipo,
                'id_ramal'   => $idRamal,
                'ramal'      => $ramal,
                'ligar_para' => $ligarPara,
                'fechar_fim' => $fecharFim
            ]
        );
    }

    /**
     * Cria uma nova URA
     * @param string $nome
     * @param array  $dados
     * @return string
     */
    public function criarUra($nome, $dados)
    {
        return $this->client->post(
            new Route([self::ROTA_URA]), [
            'nome'            => $nome,
            'dados'           => $dados
        ]);
    }

    /**
     * Remove uma Ura
     * @param  string $id
     * @return string
     */
    public function excluirUra($id)
    {
        return $this->client->delete(new Route([self::ROTA_URA, $id]));
    }

    /**
     * Atualiza uma ura
     * @param string $id
     * @param string $nome
     * @param array  $dados
     * @return string
     */
    public function atualizarUra($id, $nome, $dados)
    {
        return $this->client->put(
            new Route([self::ROTA_URA, $id]), [
                'nome'          => $nome,
                'dados'         => $dados
            ]
        );
    }

}