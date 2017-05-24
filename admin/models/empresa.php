<?php

namespace admin\models;

use app\conn\read;
use app\conn\create;
use app\conn\update;
use app\conn\delete;
use app\helper\funcoes;
use app\helper\files;

class empresa {

    private $dados;
    private $id;
    private $resultado;
    private $error;

    const tabela = 'empresas';

    //CADASTRA OS POSTS.
    public function cadastraEmpresa(array $dados) {
        $this->dados = $dados;
        if (in_array('', $this->dados)):
            $this->error = 'Por favor preencha todos os campos obrigatorios com o * no final!';
        else:
            $this->setDados();
            $this->setNome();
            $this->setCapa();
            $this->executa();
        endif;
    }

    //ATUALIZA OS POSTS.
    public function atualizaEmpresa(array $dados, $idpost) {
        $this->dados = $dados;
        $this->id = $idpost;
        if (in_array('', $this->dados)):
            $this->error = 'Por favor preencha todos os campos obrigatorios com o * no final!';
        else:
            $this->setDados();
            $this->setNome();
            $this->setCapa();
            $this->atualiza();
        endif;
    }
    
    

    //GETTER E SETTERS.
    function getResultado() {
        return $this->resultado;
    }

    function getError() {
        return $this->error;
    }

    //SETA OS DADOS
    private function setDados() {
        $this->dados['capa'] = ($this->dados['capa'] == 'null' ? null : $this->dados['capa']);
        $this->dados['url'] = funcoes::Name($this->dados['titulo']);
        $this->dados['data_criacao'] = funcoes::validaData($this->dados['data_criacao']);
        $this->dados['conteudo'] = html_entity_decode(strip_tags($this->dados['conteudo'],'<a>'));
    }

    //SETA O NOME
    private function setNome() {
        $readEmpNome = new read();
        $readEmpNome->ExeRead(self::tabela, "WHERE titulo = :t", "t={$this->dados['titulo']}");
        if ($readEmpNome->getResultado()[0]):
            $this->dados['titulo'] = $this->dados['titulo'] . '-' . time();
        endif;
    }

    //ENVIA A CAPA.
    private function setCapa() {
        //VERIFICA SE EXISTE A IMAGEM E ENVIA PARA A PASTA.
        if (isset($this->dados['capa'])):
            //APAGA A CAPA ANTIGA.
            $readCapa = new read();
            $readCapa->ExeRead('empresas', "WHERE id = :id", "id={$this->id}");
            $capaDel = '../uploads/' . $readCapa->getResultado()[0]['capa'];
            if (file_exists($capaDel) && !is_dir($capaDel)):
                unlink($capaDel);
            endif;
            
            //ENVIAR A CAPA NOVA.
            $capa = new files();
            $capa->enviarImagem($this->dados['capa'], $this->dados['url'], 'empresas');
        endif;

        //CADASTRA NO BANCO O CAMINHO DA IMAGEM.
        if (isset($capa) && $capa->getResultado()):
            $this->dados['capa'] = $capa->getResultado();
        else:
            unset($this->dados['capa']);
        endif;
    }

    //EXECUTA
    private function executa() {
        $cadastroEmp = new create();
        $cadastroEmp->ExeCreate(self::tabela, $this->dados);
        if ($cadastroEmp->getResultado()):
            $this->resultado = $cadastroEmp->getResultado(); //Ultimo id inserido.
            $this->error = 'Os dados foram cadastrados com sucesso.';
        endif;
    }

    //ATUALIZA.
    private function atualiza() {
        $atualizaEmp = new update();
        $atualizaEmp->ExeUpdate(self::tabela, $this->dados, "WHERE id = :id", "id={$this->id}");
        if ($atualizaEmp->getResultado()):
            $this->resultado = true;
            $this->error = 'Os dados foram atualizados com sucesso.';
        endif;
    }
    
    
}
