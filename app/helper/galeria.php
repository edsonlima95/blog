<?php

namespace app\helper;
use app\conn\create;
use app\conn\read;
use app\conn\delete;

class galeria {

    private $dados;
    private $id;
    private $tabela = 'posts';
    private $galeria = 'galeria_posts';
    private $error;
    private $resultado;
    
    public function getResultado() {
        return $this->resultado;
    }

   public function getError() {
        return $this->error;
    }

    public function setTabela($tabela) {
        $this->tabela = $tabela;
    }
    
    public function setGaleria($galeria) {
        $this->galeria = $galeria;
    }
    
    //ENVIA A GALERIA DE IMAGENS.
    public function enviarGaleria(array $imagens, $postid) {
        $this->dados = $imagens;
        $this->id = $postid;

        //Ler na tabela post se existe o id.
        $readPost = new read();
        $readPost->ExeRead($this->tabela, "WHERE id = :id", "id={$this->id}");
        if (!$readPost->getResultado()):
            return false;
        else:
           
            //conta o total de imagens pelo indice.
            $arrayCount = count($this->dados['tmp_name']);

            //Recupera os indecis, tmp_name, size etc.
            $arrayKeys = array_keys($this->dados);

            //Monta o array de imagem, cada imagem com seus indices.
            for ($i = 0; $i < $arrayCount; $i++):
                foreach ($arrayKeys as $key):
                    $arrayImagens[$i][$key] = $this->dados[$key][$i];
                endforeach;
            endfor;
            
            //Envia as imagens.
            $uploadImagem = new files();
            $i = 0;
            foreach ($arrayImagens as $upimagens):
                $i++; //Conta as imagens existe, sem o $i os nomes repete.
                $novoNome = "{$this->id}-" . (substr(md5(time() + $i), 0, 5));
                //Eviar as imagens
                $uploadImagem->enviarImagem($upimagens, $novoNome,'galeria');

                //Seta os campos, e salva na tabela as imagens.
                if ($uploadImagem->getResultado()):
                    $nome = $uploadImagem->getResultado();
                    $arrayDados = [
                        "id_post" => $this->id,
                        "caminho" => $nome,
                        "data_criacao" => date('Y-m-d H:i:s')
                    ];
                    $createGaleria = new create();
                    $createGaleria->ExeCreate($this->galeria, $arrayDados);
                endif;
            endforeach;
        endif;
    }
    
    //Deleta a galeria toda pelo id informado.
    public function deleteGaleria($id) {
        $this->id = $id;
        $readGaleri = new read();
        $readGaleri->ExeRead($this->galeria,"WHERE id_post = :id","id={$this->id}");
        if($readGaleri->getResultado()):
            foreach ($readGaleri->getResultado() as $res):
                $nome = '../uploads/'.$res['caminho'];
                if(file_exists($nome) && !is_dir($nome)):
                    unlink($nome);
                endif;
            endforeach;
            
            $delete = new delete();
            $delete->ExeDelete($this->galeria,"WHERE id_post = :id","id={$this->id}");
            if($delete->getResultado()):
                $this->resultado = true;
            endif;
        endif;
    }
    
    //Deleta uma imagem pelo id informado.
    public function deleteGaleriaImg($id) {
        $this->id = $id;
        $readGaleri = new read();
        $readGaleri->ExeRead($this->galeria,"WHERE id = :id","id={$this->id}");
        if($readGaleri->getResultado()):
          
        $nome = '../uploads/'.$readGaleri->getResultado()[0]['caminho'];
        if(file_exists($nome) && !is_dir($nome)):
            unlink($nome);
        endif;
           
        $delete = new delete();
        $delete->ExeDelete($this->galeria,"WHERE id = :id","id={$this->id}");
        if($delete->getResultado()):
            $this->resultado = true;
            $this->error = "A imagem foi deletada com sucesso da galeira";
        endif;
        endif;
    }
    
}
