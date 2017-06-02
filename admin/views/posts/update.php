<section class="grid-g-12 estilo-form">
    <div class="bread">
        <a href="index.php">Home</a>
        <span>/</span>
        <a class="ativo">Posts</a>
    </div>
    <?php

    use admin\models\posts;
    use app\conn\read;
    use app\helper\galeria;
    
    $posts = new posts();
    $galeria = new galeria();
    
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $idpost = filter_input(INPUT_GET,'idpost',FILTER_SANITIZE_NUMBER_INT);
   

    if (isset($dados) && $dados['enviar']):
        $dados['status'] = ($dados['enviar'] == 'Atualiza' ? 0 : 1);
        unset($dados['enviar']);
        
        //CAPA.
        $dados['capa'] = ($_FILES['capa']['tmp_name'] ? $_FILES['capa'] : 'null');      
        
        //ATUALIZA O POST.
        $posts->atualizaPosts($dados, $idpost);
        
        //ENVIA A GALERIA.
        if(isset($_FILES['galeria']['tmp_name'])):
             $galeria->enviarGaleria($_FILES['galeria'], $idpost);
        endif;
        
        if(!$posts->getResultado()):
            echo '<div class="alert">'.$posts->getError().'<span class="x">X</span></div>';
        else:
            echo '<div class="success">'.$posts->getError().'<span class="x">X</span></div>';
        endif;
    else:
        $readPost = new read();
        $readPost->ExeRead('posts',"WHERE id = :id","id={$idpost}");
        $dados = $readPost->getResultado()[0];
        $dados['data_criacao'] = $dados['data_criacao'] ? date('d/m/Y H:i:s',strtotime($dados['data_criacao'])) : date('d/m/Y'); 
    endif;
    
    //DELETA A IMAGEM.
    $iddelgal = filter_input(INPUT_GET,'iddelgal',FILTER_VALIDATE_INT);
    if($iddelgal):
        $galeria->deleteGaleriaImg($iddelgal);
        echo '<div class="success">'.$galeria->getError().'<span class="x">X</span></div>';
    endif;
    ?>

    <h1>Atualiza posts</h1>

    <form method="post" enctype="multipart/form-data" class="grid-g-9 grid-m-12">
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="capa">Capa </label>
            <input type="file" name="capa" id="capa" placeholder="Capa" style="padding: 0px">
        </div>
        <div class="grid-g-5 grid-m-5">
            <label for="gal">Galeria de fotos </label>
            <input type="file" name="galeria[]" multiple id="gal" placeholder="Galeira" style="padding: 0px">
        </div>
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="titulo">Titulo </label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo" value="<?php if(isset($dados['titulo'])) echo $dados['titulo'];?>">
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="cat">Categoria </label>
            <select id="cat" name="id_sub">
                <option value="" disabled="" selected="">Selecione uma categoria</option>
                <?php
                $readCatPai = new read();
                $readCatPai->ExeRead('categorias', "WHERE id_pai IS NULL ORDER BY nome ASC");
                foreach ($readCatPai->getResultado() as $resPai):
                    echo '<option disabled >' . ucfirst($resPai['nome']) . '</option>';
                    $readCatSub = new read();
                    $readCatSub->ExeRead('categorias', "WHERE id_pai = :idpai ORDER BY nome ASC", "idpai={$resPai['id']}");
                    foreach ($readCatSub->getResultado() as $resSub):
                        echo '<option value="' . $resSub['id'] . '"';
                            if($resSub['id'] == $dados['id_sub']) echo 'selected';
                        echo '>' . ucfirst($resSub['nome']) . '</option>';
                    endforeach;
                endforeach;
                ?>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5" style="margin-right: 20px">
            <label for="autor">Autor </label>
            <select id="autor" name="autor">
                <option value="" disabled="" selected="">Selecione um autor</option>
                <?php
                $readAutor = new read();
                $readAutor->ExeRead('usuarios', "ORDER BY nome ASC");
                foreach ($readAutor->getResultado() as $resAut):
                    echo '<option value="' . $resAut['nome'] . '"';
                        if($resAut['id'] == $dados['autor'])  echo 'selected';
                    echo '>' . ucfirst($resAut['nome']) . '</option>';
                endforeach;
                ?>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="data">Data </label>
            <input type="data" id="data" name="data_criacao" value="<?php if($dados['data_criacao']) echo $dados['data_criacao'];?>">
        </div>

        <div class="grid-m-12">
            <label for="textarea">Descrição</label>
            <textarea name="conteudo" id="textarea" placeholder="Descrição"><?php if(isset($dados['conteudo'])) echo $dados['conteudo'];?></textarea>
        </div>
        
        <input type="submit" name="enviar" class="btn-blue" value="Atualizar e publicar">
        <input type="submit" name="enviar" class="btn-green" value="Atualiza">
        
    </form>
    <div class="grid-g-12 galeria-imgs">
            <?php 
            $readGal = new read();
            $readGal->ExeRead('galeria_posts',"WHERE id_post = :id","id={$idpost}");
            if($readGal->getResultado()):
            foreach ($readGal->getResultado() as $resGal):    
            ?>
            <div class="grid-g-3 grid-m-3">
                    <a href="<?= BASE .'../../../uploads/'.$resGal['caminho']?>" rel="shadowbox[$idpost]">
                        <img src="<?= BASE .'../../../uploads/'.$resGal['caminho']?>" alt="" title="" width="100%" height="170px">
                        <a href="index.php?exe=posts/update&idpost=<?=$dados['id']?>&iddelgal=<?=$resGal['id']?>"><i class="fa fa-times del"></i></a>
                    </a>
                </div>
            <?php
            endforeach;
            else:

            endif;
            ?>
        </div>
</section>