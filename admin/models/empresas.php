<?php

namespace admin\models;

use app\helper\funcoes;
use app\conn\read;
use app\conn\create;
use app\conn\update;
use app\conn\delete;

class empresas {

    private $dados;
    private $id;
    private $resultado;
    private $error;

    const tabela = 'categoria_empresas';

    //CADASTRO DE EMPRESAS
    public function cadastraEmpresas(array $dados) {
        $this->dados = $dados;
        if (in_array('', $dados)):
            $this->error = 'Por favor preencha todos os campos obrigatorios com o * no final!';
        else:
            $this->setDados();
            $this->setNome();
            $this->executa();
        endif;
    }

    //ATUALIZA AS CATEGORIAS.
    public function atualizaEmpresas(array $dados, $id) {
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

    //DELETA AS EMPRESAS.
    public function deletaEmpresa($idemp) {
        $this->id = $idemp;
        $readSub = new read();
        $readSub->ExeRead(self::tabela, "WHERE id = :id", "id={$this->id}");
        if (!$readSub->getRowCount() > 0):
            $this->resultado = false;
            $this->error = 'A categoria que você tentou deletar não existe!';
        else:
            $readEmpresas = new read();
            $readEmpresas->ExeRead('empresas', "WHERE id_cat = :idc", "idc={$this->id}");
            if ($readEmpresas->getResultado()[0]):
                $this->error = 'A categória não pode ser deletada, contém empresas cadastradas!';
            else:
                $this->deleta();
            endif;

        endif;
    }

    function getResultado() {
        return $this->resultado;
    }

    function getError() {
        return $this->error;
    }

    //SETA OS DADOS
    private function setDados() {
        $this->dados['url'] = funcoes::Name($this->dados['titulo']);
        $this->dados['data_criacao'] = funcoes::validaData($this->dados['data_criacao']);
        $this->dados['conteudo'] = html_entity_decode(strip_tags($this->dados['conteudo']));
    }

    //SETA O NOME
    private function setNome() {
        $readEmpNome = new read();
        $readEmpNome->ExeRead(self::tabela, "WHERE titulo = :t", "t={$this->dados['titulo']}");
        if ($readEmpNome->getResultado()):
            $this->dados['titulo'] = $this->dados['titulo'] . '-' . time();
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

    //ATUALIZA
    private function atualiza() {
        $updateCat = new update();
        $updateCat->ExeUpdate(self::tabela, $this->dados, "WHERE id = :id", "id={$this->id}");
        if ($updateCat->getResultado()):
            $this->resultado = true;
            $this->error = 'Os dados foram atualizados com sucesso.';
        endif;
    }

    //DELETA EMPRESA.
    private function deleta() {
        $deletaCat = new delete();
        $deletaCat->ExeDelete(self::tabela, "WHERE id = :id", "id={$this->id}");
        if ($deletaCat->getResultado()):
            $this->resultado = true;
            $this->error = 'Os dados foram deletados com sucesso.';
            header('refresh: 3; url=index.php?exe=empresas_cat/index');
        endif;
    }

}
