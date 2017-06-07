<?php

namespace admin\models;

use app\helper\funcoes;
use app\helper\files;
use app\conn\read;
use app\conn\delete;
use app\conn\update;
use app\conn\create;

/**
 * Description of usuarios
 *
 * @author edsonlima
 */
class usuarios {

    private $dados;
    private $id;
    private $error;
    private $resultado;

    const tabela = 'usuarios';

    public function getError() {
        return $this->error;
    }

    public function getResultado() {
        return $this->resultado;
    }

    //CADASTRA O USUARIO.
    public function cadastraUsuario(array $dados) {
        $this->dados = $dados;

        if (in_array('', $this->dados)):
            $this->error = 'Por favor preencha todos os campos obrigatorios com o * no final!';
        elseif ($this->verficaEmail()):
            $this->error = 'O email já existe, porfavor insira outro email!';
        else:
            $this->setDados();
            $this->setNome();
            $this->setCapa();
            $this->executa();
        endif;
    }

    //ATUALIZA O USUARIO.
    public function atualizaUsuario(array $dados, $iduser) {
        $this->dados = $dados;
        $this->id = $iduser;

        if (in_array('', $this->dados)):
            $this->error = 'Por favor preencha todos os campos obrigatorios com o * no final!';
        else:
            $this->setDados();
            $this->setCapa();
            $this->atualiza();
        endif;
    }

    //DELETA USUARIO.
    public function deletaUsuario($id) {
        $this->id = $id;
        $readUser = new read();
        $readUser->ExeRead('usuarios', "WHERE id = :id", "id={$this->id}");
        if ($readUser->getResultado()[0]):
            $user = $readUser->getResultado()[0];
            if($user['id'] == $_SESSION['user']['id']):
                $this->error = 'Você não pode excluir o seu próprio perfil!';
            else:
                //APAGA A CAPA ANTIGA.
                $readCapa = new read();
                $readCapa->ExeRead(self::tabela, "WHERE id = :id", "id={$this->id}");
                $capaDel = '../uploads/' . $readCapa->getResultado()[0]['capa'];
                if (file_exists($capaDel) && !is_dir($capaDel)):
                    unlink($capaDel);
                endif;
                $this->deleta();
            endif;
        endif;
    }

    private function setDados() {
        $this->dados['capa'] = ($this->dados['capa'] == 'null' ? null : $this->dados['capa']);
        $this->dados['data_criacao'] = funcoes::validaData($this->dados['data_criacao']);
        $this->dados['password'] = $this->dados['token'];
        $this->dados['password'] = md5(base64_decode($this->dados['password']));
    }

    //SETA O NOME
    private function setNome() {
        $readNome = new read();
        $readNome->ExeRead(self::tabela, "WHERE nome = :n", "n={$this->dados['nome']}");
        if ($readNome->getResultado()):
            $this->dados['nome'] = $this->dados['nome'] . '-' . time();
        endif;
    }

    //VERIFICA EMAIL.
    public function verficaEmail() {
        $readEmail = new read();
        $readEmail->ExeRead(self::tabela, "WHERE email = :e", "e={$this->dados['email']}");
        if ($readEmail->getResultado()):
            return true;
        else:
            return false;
        endif;
    }

    //ENVIA A CAPA.
    private function setCapa() {

        //VERIFICA SE EXISTE A IMAGEM E ENVIA PARA A PASTA.
        if (!empty($this->dados['capa'])):
            //SE O ID EXISTIR
            if ($this->id):
                //APAGA A CAPA ANTIGA.
                $readCapa = new read();
                $readCapa->ExeRead(self::tabela, "WHERE id = :id", "id={$this->id}");
                $capaDel = '../uploads/' . $readCapa->getResultado()[0]['capa'];
                if (file_exists($capaDel) && !is_dir($capaDel)):
                    unlink($capaDel);
                endif;
            endif;

            //ENVIAR A CAPA.
            $capa = new files();
            $capa->enviarImagem($this->dados['capa'], funcoes::Name($this->dados['nome']), 'usuarios');
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
        $cadastroUser = new create();
        $cadastroUser->ExeCreate(self::tabela, $this->dados);
        if ($cadastroUser->getResultado()):
            $this->resultado = $cadastroUser->getResultado(); //Ultimo id inserido.
            $this->error = 'Os dados foram cadastrados com sucesso.';
        endif;
    }

    //ATUALIZA
    private function atualiza() {
        $atualizaUser = new update();
        $atualizaUser->ExeUpdate(self::tabela, $this->dados, "WHERE id = :id", "id={$this->id}");
        if ($atualizaUser->getResultado()):
            $this->resultado = $atualizaUser->getResultado(); //Ultimo id inserido.
            $this->error = 'Os dados foram atualizados com sucesso.';
        endif;
    }
    
    //DELETA
    private function deleta() {
        $deletaUser = new delete();
        $deletaUser->ExeDelete(self::tabela,"WHERE id = :id", "id={$this->id}");
        if ($deletaUser->getResultado()):
            $this->resultado = $deletaUser->getResultado(); //Ultimo id inserido.
            $this->error = 'Os dados foram deletados com sucesso.';
        endif;
    }

}
