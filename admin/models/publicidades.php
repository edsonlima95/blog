<?php

namespace admin\models;

use app\conn\create;
use app\helper\files;
use app\helper\funcoes;

/**
 * Description of publicidades
 *
 * @author edsonlima
 */
class publicidades {

    private $dados;
    private $id;
    private $resultado;
    
    function getResultado() {
        return $this->resultado;
    }

    public function cadastraPub(array $imgs) {
        $this->dados = $imgs;

        if (in_array('', $this->dados)):
            $this->error = 'Por favor preencha todos os campos obrigatorios com o * !';
        else:
            $this->setCapa();
        endif;
    }

    private function setCapa() {
        $files = new files();
        $files->enviarImagem($this->dados['caminho'], funcoes::Name($this->dados['nome']), 'publicidade');
       
        if (isset($files) && $files->getResultado()):
            $this->dados['data_criacao'] = date('Y-m-d H:i:s');
            $this->dados['caminho'] = $files->getResultado();
            $create = new create();
            $create->ExeCreate('publicidades', $this->dados);
            $this->resultado = true;
        endif;
    }

}
