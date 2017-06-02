<section class="grid-g-12 estilo-form" style="height: 100%">
    <h1>Atualizar usuários</h1>

    <?php

    use admin\models\usuarios;
    use app\conn\read;

    $usuario = new usuarios();

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $iduser = filter_input(INPUT_GET, 'iduser', FILTER_VALIDATE_INT);

    if (isset($dados) && $dados['enviar']):
        unset($dados['enviar']);

        //CAPA.
        $dados['capa'] = $_FILES['capa']['tmp_name'] ? $_FILES['capa'] : 'null';

        //CADASTRA O USUARIO.
        $usuario->atualizaUsuario($dados, $iduser);

        if (!$usuario->getResultado()):
            echo '<div class="alert">' . $usuario->getError() . '<span class="x">X</span></div>';
        else:
            echo '<div class="success">' . $usuario->getError() . '<span class="x">X</span></div>';
        endif;
    else:
        $readUsuarios = new read();
        $readUsuarios->ExeRead('usuarios', "WHERE id = :id", "id={$iduser}");
        if ($readUsuarios->getResultado()[0]):

            $dados = $readUsuarios->getResultado()[0];
            $dados['data_criacao'] = ($dados['data_criacao'] ? date('d/m/Y', strtotime($dados['data_criacao'])) : date('d/m/Y'));
        endif;
    endif;
    ?>

    <form method="post" enctype="multipart/form-data" class="grid-g-9 grid-m-12">
        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="capa">Foto </label>
            <input type="file" name="capa" id="capa" placeholder="Capa" style="padding: 0px">
        </div>
        <div class="grid-g-5 grid-m-5">
            <label for="nome">Nome </label>
            <input type="text" name="nome" id="nome" placeholder="Nome" value="<?php if ($dados['nome']) echo $dados['nome']; ?>">
        </div>

        <div class="grid-g-5 grid-m-5" style="margin-right: 20px;">
            <label for="email">Email </label>
            <input type="email" name="email" id="email" placeholder="Email" value="<?php if ($dados['email']) echo $dados['email']; ?>">
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="password">Senha </label>
            <input type="password" name="token" id="password" placeholder="Senha" value="<?php if ($dados['token']) echo $dados['token']; ?>">
        </div>

        <div class="grid-g-5 grid-m-5" style="margin-right: 20px">
            <label for="nivel">Nivel </label>
            <select id="nivel" name="nivel">
                <option value="">Selecione um autor</option>
                <?php
                $readAut = new read();
                $readAut->ExeRead('usuarios', "WHERE id = :id", "id={$dados['id']}");
                if ($readAut->getResultado()[0]):
                    $res = $readAut->getResultado()[0];
                    if ($res['nivel'] == 1):
                        echo '<option value="1" selected >Super Admin</option>';
                    else:
                        echo '<option value="2" selected >Admin</option>';
                    endif;
                endif;
                ?>
            </select>
        </div>

        <div class="grid-g-5 grid-m-5">
            <label for="data">Data </label>
            <input type="data" id="data" name="data_criacao" value="<?= date('d/m/Y') ?>">
        </div>
        <div class="grid-g-10">
            <input type="submit" name="enviar" class="btn-blue" value="Atualizar">
        </div>
    </form>
</section>