<?php

namespace admin\models;

use app\conn\read;
use app\conn\create;
use app\conn\update;
use app\conn\delete;
use app\helper\funcoes;
use app\helper\files;
use app\helper\galeria;

class posts {

    private $dados;
    private $id;
    private $resultado;
    private $error;

    const tabela = 'posts';

    //CADASTRA OS POSTS.
    public function cadastraPosts(array $dados) {
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
    public function atualizaPosts(array $dados, $idpost) {
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
    
    //DELETA O POSTS.
    public function deletaPosts($id) {
        $this->id = $id;
        $readPost = new read();
        $readPost->ExeRead('posts',"WHERE id = :id","id={$this->id}");
        if($readPost->getRowCount() > 0):
            $readGal = new read();
            $readGal->ExeRead('galeria_posts',"WHERE id_post = :id","id={$this->id}");
            if($readGal->getResultado()):
             $galeria = new galeria();
             $galeria->deleteGaleria($this->id);
             else:
                 
            endif;
        endif;
        $this->deleta();
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
        $this->dados['conteudo'] = html_entity_decode(strip_tags($this->dados['conteudo'],'<a>'));//Permite apenas a tag <a>
        $this->getIdCat();
    }

    //SETA O NOME
    private function setNome() {
        $readCatNome = new read();
        $readCatNome->ExeRead(self::tabela, "WHERE titulo = :t", "t={$this->dados['titulo']}");
        if ($readCatNome->getResultado()[0]):
            $this->dados['titulo'] = $this->dados['titulo'] . '-' . time();
        endif;
    }

    //OBTEM O ID DA CATEGORIA.
    private function getIdCat() {
        $getCatId = new read();
        $getCatId->ExeRead('categorias', "WHERE id = :id", "id={$this->dados['id_sub']}");
        if ($getCatId->getResultado()[0]):
            $this->dados['id_cat'] = $getCatId->getResultado()[0]['id_pai'];
        endif;
    }

    //ENVIA A CAPA.
    private function setCapa() {

        //VERIFICA SE EXISTE A IMAGEM E ENVIA PARA A PASTA.
        if (isset($this->dados['capa'])):
            //APAGA A CAPA ANTIGA.
            $readCapa = new read();
            $readCapa->ExeRead('posts', "WHERE id = :id", "id={$this->id}");
            $capaDel = '../uploads/' . $readCapa->getResultado()[0]['capa'];
            if (file_exists($capaDel) && !is_dir($capaDel)):
                unlink($capaDel);
            endif;

            //ENVIAR A CAPA.
            $capa = new files();
            $capa->enviarImagem($this->dados['capa'], $this->dados['url'], 'posts');
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
        $cadastroPost = new create();
        $cadastroPost->ExeCreate(self::tabela, $this->dados);
        if ($cadastroPost->getResultado()):
            $this->resultado = $cadastroPost->getResultado(); //Ultimo id inserido.
            $this->error = 'Os dados foram cadastrados com sucesso.';
        endif;
    }

    //ATUALIZA.
    private function atualiza() {
        $atualizaPost = new update();
        $atualizaPost->ExeUpdate(self::tabela, $this->dados, "WHERE id = :id", "id={$this->id}");
        if ($atualizaPost->getResultado()):
            $this->resultado = true;
            $this->error = 'Os dados foram atualizados com sucesso.';
        endif;
    }

    //DELETA
    private function deleta() {
        $deletaPost = new delete();
        $deletaPost->ExeDelete(self::tabela,"WHERE id = :id","id={$this->id}");
        if ($deletaPost->getResultado()):
            $this->resultado = true;
            $this->error = 'Os dados foram deletados com sucesso.';
             header('refresh: 3; url=index?exe=posts/index');
        endif;
    }

}
