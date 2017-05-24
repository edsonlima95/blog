<?php

namespace admin\models;

use app\helper\funcoes;
use app\conn\read;
use app\conn\create;
use app\conn\update;
use app\conn\delete;

class categorias {

    private $dados;
    private $id;
    private $resultado;
    private $error;

    const tabela = 'categorias';

    function getResultado() {
        return $this->resultado;
    }

    function getError() {
        return $this->error;
    }

    //CADASTRA AS CATEGORIAS.
    public function cadastraCategoria(array $dados) {
        $this->dados = $dados;
        if (in_array('', $dados)):
            $this->error = 'Por favor preencha todos os campos obrigatorios com o * no final!';
        else:
            $this->setDados();
            $this->setNome();
            $this->executa();
        endif;
    }

    //CADASTRA AS CATEGORIAS.
    public function atualizaCategoria(array $dados, $id) {
        $this->dados = $dados;
        $this->id = $id;
        if (in_array('', $dados)):
            $this->error = 'Por favor preencha todos os campos obrigatorios com o * no final!';
        else:
            $this->setDados();
            $this->setNome();
            $this->atualiza();

        endif;
    }

    public function deletaCategoria($idcat) {
        $this->id = $idcat;
        $readSub = new read();
        $readSub->ExeRead('categorias', "WHERE id_pai = :id", "id={$this->id}");
        if ($readSub->getRowCount() > 0):
            $this->resultado = false;
            $this->error = 'A categória contém sub-categórias, não pode ser deletada!';
        else:
            $readPost = new read();
            $readPost->ExeRead('posts',"WHERE id_sub = :id","id={$this->id}");
            if($readPost->getResultado()[0]):
                $this->error =  'Tem posts';
            else:
            $this->deleta();
            endif;
        endif;
    }

    //SETA OS DADOS
    private function setDados() {
        $this->dados['id_pai'] = ($this->dados['id_pai'] == 'null' ? null : $this->dados['id_pai']);
        $this->dados['url'] = funcoes::Name($this->dados['titulo']);
        $this->dados['data_criacao'] = funcoes::validaData($this->dados['data_criacao']);
        $this->dados['conteudo'] = html_entity_decode(strip_tags($this->dados['conteudo']));
    }

    //SETA O NOME
    private function setNome() {
        $readCatNome = new read();
        $readCatNome->ExeRead(self::tabela, "WHERE titulo = :t", "t={$this->dados['titulo']}");
        if ($readCatNome->getResultado()[0]):
            $this->dados['titulo'] = $this->dados['titulo'] . '-' . time();
        endif;
    }

    //EXECUTA
    private function executa() {
        $cadastroCat = new create();
        $cadastroCat->ExeCreate(self::tabela, $this->dados);
        if ($cadastroCat->getResultado()):
            $this->resultado = $cadastroCat->getResultado(); //Ultimo id inserido.
            $this->error = 'Os dados foram cadastrados com sucesso.';
        endif;
    }

    //ATUALIZA
    private function atualiza() {
        $updateCat = new update();
        $updateCat->ExeUpdate(self::tabela, $this->dados, "WHERE id = :id", "id={$this->id}");
        if ($updateCat->getResultado()):
            $this->resultado = true;
            $this->error = 'Os dados foram atualizados com sucesso.';
        endif;
    }

    //DELETA CATEGORIA.
    private function deleta() {
        $deletaCat = new delete();
        $deletaCat->ExeDelete(self::tabela, "WHERE id = :id", "id={$this->id}");
        if ($deletaCat->getResultado()):
            $this->resultado = true;
            $this->error = 'Os dados foram deletados com sucesso.';
            header('refresh: 3; url=index?exe=categorias/index');
        endif;
    }

}
