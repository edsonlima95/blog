<section class="grid-g-12 estilo-form">
    <div class="bread">
        <a href="index">Home</a>
        <span>/</span>
        <a href="#">Empresa</a>
        <span>/</span>
        <a class="ativo">Editar</a>
    </div>
    <?php

    use app\conn\read;
    use admin\models\empresa;
    use app\helper\galeria;

    $empresa = new empresa();
    $empGaleria = new galeria();
    
    //SETA OS VALORES DAS TABELAS
    $empGaleria->setTabela('empresas');
    $empGaleria->setGaleria('galeria_empresas');
    
    //Recebe os dados do formulario.
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //Id da empresa.
    $idemp = filter_input(INPUT_GET,'idemp', FILTER_VALIDATE_INT);
    
    if (isset($dados) && $dados['enviar']):
        $dados['status'] = $dados['enviar'] == 'Cadastrar' ? 0 : 1;
        unset($dados['enviar']);
        $dados['capa'] = $_FILES['capa']['tmp_name'] ? $_FILES['capa'] : 'null';

        $empresa->atualizaEmpresa($dados, $idemp);

        //GALERIA.
        if (isset($_FILES['gal']['tmp_name'])):
           
            $empGaleria->enviarGaleria($_FILES['gal'], $idemp);
        endif;

        if (!$empresa->getResultado()):
            echo '<div class="alert">' . $empresa->getError() . '<span class="x">X</span></div>';
        else:
            echo '<div class="success">' . $empresa->getError() . '<span class="x">X</span></div>';
        endif;
    else:
        $readEmpresa = new read();
        $readEmpresa->ExeRead('empresas',"WHERE id = :id","id={$idemp}");
        $dados = $readEmpresa->getResultado()[0];
        $dados['data_criacao'] = $dados['data_criacao'] ? date('d/m/Y H:i:s',strtotime($dados['data_criacao'])) : date('d/m/Y'); 
    endif;
    
    //DELETA A IMAGEM DA GALERIA.
    $idgal = filter_input(INPUT_GET,'iddelgal', FILTER_VALIDATE_INT);
    if($idgal):
        $empGaleria->deleteGaleriaImg($idgal);
        echo '<div class="success">'.$empGaleria->getError().'<span class="x">X</span></div>';
    endif;
    ?>

    <h1>Cadastro de empresas</h1>

    <form method="post" enctype="multipart/form-data" class="grid-g-9 grid-m-12">
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="capa">Capa </label>
            <input type="file" name="capa" id="capa" placeholder="Capa" style="padding: 0px">
        </div>

        <div class="grid-g-5 grid-m-5" >
            <label for="capa">Galeria de imagens</label>
            <input type="file" name="gal[]" multiple id="capa" placeholder="Galeria de imagens" style="padding: 0px">
        </div>

        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="titulo">Nome </label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo" value="<?php if(isset($dados['titulo'])) echo $dados['titulo']; ?>">
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="end">Endereço </label>
            <input type="text" name="endereco" id="end" placeholder="Endereço" value="<?php if(isset($dados['endereco'])) echo $dados['endereco']; ?>">
        </div>

        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="bai">Bairro </label>
            <input type="text" name="bairro" id="bai" placeholder="Bairro" value="<?php if(isset($dados['bairro'])) echo $dados['bairro']; ?>">
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="estado">Estado </label>
            <select id="estado" name="estado">
                <option value="">Selecione uma categoria</option>
                <?php
                $readEstados = new read();
                $readEstados->ExeRead('estados', "ORDER BY estado_nome ASC");
                foreach ($readEstados->getResultado() as $resEst):
                    echo '<option value="' . $resEst['estado_id'] . '"';
                    if($resEst['estado_id'] == $dados['estado'])  echo 'selected';
                    echo '>'. $resEst['estado_nome'] . '</option>';
                endforeach;
                ?>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="cidade">Cidade </label>
            <select id="cidade" name="cidade">
                <option value="" disabled="" selected="">Selecione um estado!</option>
                <?php
                $readCidades = new read();
                $readCidades->ExeRead('cidades',"WHERE estado_id = :id ORDER BY cidade_nome ASC","id={$dados['estado']}");
                foreach ($readCidades->getResultado() as $resCit):
                    echo '<option value="' . $resCit['cidade_id'] . '"';
                    if($resCit['cidade_id'] == $dados['cidade'])  echo 'selected';
                    echo '>'. $resCit['cidade_nome'] . '</option>';
                endforeach;
                ?>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="cont">Contato </label>
            <input type="text" name="contato" id="cont" placeholder="Contato" value="<?php if(isset($dados['contato'])) echo $dados['contato']; ?>">
        </div>


        <div class="grid-g-5 grid-m-5" style="margin-right: 20px">
            <label for="cat">Categoria </label>
            <select id="cat" name="id_cat">
                <option value="" disabled="" selected="">Selecione uma categoria</option>
                <?php
                $readCatEmp = new read();
                $readCatEmp->ExeRead('categoria_empresas', "ORDER BY titulo ASC");
                foreach ($readCatEmp->getResultado() as $resCatEmp):
                    echo '<option value="' . $resCatEmp['id'] . '"';
                        if($resCatEmp['id'] == $dados['id_cat']) echo 'selected';
                    echo '>' . $resCatEmp['titulo'] . '</option>';
                endforeach;
                ?>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="data">Data </label>
            <input type="data" id="data" name="data_criacao" value="<?php if(isset($dados['data_criacao'])) echo $dados['data_criacao']; ?>">
        </div>

        <div class="grid-m-12">
            <label for="textarea">Descrição</label>
            <textarea name="conteudo" id="textarea" placeholder="Descrição"><?php if(isset($dados['conteudo'])) echo $dados['conteudo']; ?></textarea>
        </div>
        <input type="submit" name="enviar" class="btn-green" value="Cadastrar">
        <input type="submit" name="enviar" class="btn-blue" value="Cadastrar e publicar">
        
        <div class="grid-g-12 galeria-imgs">
            <?php 
            $readGal = new read();
            $readGal->ExeRead('galeria_empresas',"WHERE id_post = :id","id={$dados['id']}");
            if($readGal->getResultado()):
            foreach ($readGal->getResultado() as $resGal):    
            ?>
            <div class="grid-g-3 grid-m-3">
                    <a href="<?= BASE.'/uploads/'.$resGal['caminho'];?>" rel="shadowbox[idpost]">
                        <img src="<?= BASE.'/uploads/'.$resGal['caminho'];?>" alt="" title="" width="100%" height="170px">
                        <a href="index.php?exe=empresas/update&idemp=<?=$dados['id']?>&iddelgal=<?=$resGal['id']?>"><i class="fa fa-times del"></i></a>
                    </a>
                </div>
            <?php
            endforeach;
            else:

            endif;
            ?>
        </div>
    </form>
</section>