<section class="grid-g-12 estilo-form">
    <div class="bread">
        <a href="index">Home</a>
        <span>/</span>
        <a class="ativo">Posts</a>
    </div>
    <?php

    use admin\models\posts;
    use app\conn\read;
    use app\helper\galeria;
    
    $posts = new posts();
    
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($dados) && $dados['enviar']):
        $dados['status'] = ($dados['enviar'] == 'Cadastrar' ? '0' : 1);
        unset($dados['enviar']);
        
        //CAPA.
        $dados['capa'] = ($_FILES['capa']['tmp_name'] ? $_FILES['capa'] : 'null');      
        $posts->cadastraPosts($dados);
        
        //GALERIA.
        if(isset($_FILES['galeria']['tmp_name'])):
             $galeria = new galeria();
             $galeria->enviarGaleria($_FILES['galeria'], $posts->getResultado());
        endif;
        
        if(!$posts->getResultado()):
            echo '<div class="alert">'.$posts->getError().'<span class="x">X</span></div>';
        else:
            echo '<div class="success">'.$posts->getError().'<span class="x">X</span></div>';
        endif;
    endif;
    ?>

    <h1>Cadastro de posts</h1>

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
            <label for="titulo">Titulo <span style="color: red">*</span></label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo">
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="cat">Categoria <span style="color: red">*</span></label>
            <select id="cat" name="id_sub">
                <option value="" selected="">Selecione uma categoria</option>
                <?php
                $readCatPai = new read();
                $readCatPai->ExeRead('categorias', "WHERE id_pai IS NULL ORDER BY nome ASC");
                foreach ($readCatPai->getResultado() as $resPai):
                    echo '<option disabled >' . ucfirst($resPai['nome']) . '</option>';
                    $readCatSub = new read();
                    $readCatSub->ExeRead('categorias', "WHERE id_pai = :idpai ORDER BY nome ASC", "idpai={$resPai['id']}");
                    foreach ($readCatSub->getResultado() as $resSub):
                        echo '<option value="' . $resSub['id'] . '">' . ucfirst($resSub['nome']) . '</option>';
                    endforeach;
                endforeach;
                ?>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5" style="margin-right: 20px">
            <label for="autor">Autor <span style="color: red">*</span></label>
            <select id="autor" name="autor">
                <option value="">Selecione um autor</option>
                <?php
                $readAutor = new read();
                $readAutor->ExeRead('usuarios', "ORDER BY nome ASC");
                foreach ($readAutor->getResultado() as $resAut):
                    echo '<option value="' . $resAut['nome'] . '">' . ucfirst($resAut['nome']) . '</option>';
                endforeach;
                ?>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="data">Data </label>
            <input type="date" id="data" name="data_criacao" value="<?= date('d/m/Y H:i:s') ?>">
        </div>
        
        <div class="grid-m-12">
            <label for="textarea">Descrição <span style="color: red">*</span></label>
            <textarea name="conteudo" id="textarea" placeholder="Descrição"></textarea>
        </div>
        <input type="submit" name="enviar" class="btn-blue" value="Cadastrar e publicar">
        <input type="submit" name="enviar" class="btn-green" value="Cadastrar">
    </form>
</section>