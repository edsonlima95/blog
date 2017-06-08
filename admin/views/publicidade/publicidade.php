<section class="grid-g-12 estilo-form">
    <h1>Cadastrar usuários</h1>

    <?php

    use app\helper\files;
    use app\conn\create;
    use app\helper\funcoes;

$file = new files();

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($dados) && $dados['enviar']):
        unset($dados['enviar']);

        if (in_array('', $dados)):
            echo '<div class="alert">Preencha todos os campos com * !<span class="x">X</span></div>';
        else:
            //Envia a capa.
            $file->enviarImagem($_FILES['capa'], funcoes::Name($dados['nome']), 'publicidade');

            //Salva no banco o caminho.
            if (isset($file) && $file->getResultado()):
                //SETA DADOS.
                $dados['capa'] = $file->getResultado();
                $dados['data_criacao'] = date('Y-m-d H:i:s');
                
                //SALVA NO BANCO.
                $create = new create();
                $create->ExeCreate('publicidades', $dados);
            endif;
            if (!$create->getResultado()):
                echo '<div class="alert">Erro ao tentar enviar a publicidade!<span class="x">X</span></div>';
            else:
                echo '<div class="success">Publicidade cadastrada com sucesso!<span class="x">X</span></div>';
            endif;
        endif;
    endif;
    ?>

    <form method="post" enctype="multipart/form-data" class="grid-g-9 grid-m-12">
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="capa">Publicidade <span style="color: red">*</span></label>
            <input type="file" name="capa" id="capa" placeholder="Capa" style="padding: 0px">
        </div>
        <div class="grid-g-5 grid-m-5">
            <label for="nome">Nome <span style="color: red">*</span></label>
            <input type="text" name="nome" id="nome" placeholder="Nome">
        </div>

        <div class="grid-g-10">
            <input type="submit" name="enviar" class="btn-green" value="Cadastrar">
        </div>
    </form>
</section>