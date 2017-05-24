<section class="grid-g-12 estilo-form">
    <div class="bread">
        <a href="index">Home</a>
        <span>/</span>
        <a class="ativo">Empresa</a>
    </div>
    <?php

    use app\conn\read;
    use admin\models\empresa;
    use app\helper\galeria;

$empresa = new empresa();

    //Recebe os dados do formulario.
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($dados) && $dados['enviar']):
        $dados['status'] = $dados['enviar'] == 'Cadastrar' ? 0 : 1;
        unset($dados['enviar']);
        $dados['capa'] = $_FILES['capa']['tmp_name'] ? $_FILES['capa'] : 'null';

        $empresa->cadastraEmpresa($dados);

        //GALERIA.
        if (isset($_FILES['gal']['tmp_name'])):
            $empGaleria = new galeria();
            $empGaleria->setTabela('empresas');
            $empGaleria->enviarGaleria($_FILES['gal'], $empresa->getResultado());
        endif;

        if (!$empresa->getResultado()):
            echo '<div class="alert">' . $empresa->getError() . '<span class="x">X</span></div>';
        else:
            echo '<div class="success">' . $empresa->getError() . '<span class="x">X</span></div>';
        endif;
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
            <input type="text" name="titulo" id="titulo" placeholder="Titulo">
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="end">Endereço </label>
            <input type="text" name="endereco" id="end" placeholder="Endereço">
        </div>

        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="bai">Bairro </label>
            <input type="text" name="bairro" id="bai" placeholder="Bairro">
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="estado">Estado </label>
            <select id="estado" name="estado">
                <option value="" disabled="" selected="">Selecione uma categoria</option>
                <?php
                $readEstados = new read();
                $readEstados->ExeRead('estados', "ORDER BY estado_nome ASC");
                foreach ($readEstados->getResultado() as $resEst):
                    echo '<option value="' . $resEst['estado_id'] . '">' . $resEst['estado_nome'] . '</option>';
                endforeach;
                ?>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="cidade">Cidade </label>
            <select id="cidade" name="cidade">
                <option value="" disabled="" selected="">Selecione um estado!</option>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="cont">Contato </label>
            <input type="text" name="contato" id="cont" placeholder="Contato">
        </div>


        <div class="grid-g-5 grid-m-5" style="margin-right: 20px">
            <label for="cat">Categoria </label>
            <select id="cat" name="id_cat">
                <option value="" disabled="" selected="">Selecione uma categoria</option>
                <?php
                $readCatEmp = new read();
                $readCatEmp->ExeRead('categoria_empresas', "ORDER BY titulo ASC");
                foreach ($readCatEmp->getResultado() as $resCatEmp):
                    echo '<option value="' . $resCatEmp['id'] . '">' . $resCatEmp['titulo'] . '</option>';
                endforeach;
                ?>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="data">Data </label>
            <input type="date" id="data" name="data_criacao" value="<?= date('d/m/Y') ?>">
        </div>

        <div class="grid-m-12">
            <label for="textarea">Descrição</label>
            <textarea name="conteudo" id="textarea" placeholder="Descrição"></textarea>
        </div>
        <input type="submit" name="enviar" class="btn-green" value="Cadastrar">
        <input type="submit" name="enviar" class="btn-blue" value="Cadastrar e publicar">
    </form>
</section>