<?php

use app\helper\funcoes;
use app\conn\read;
use admin\models\posts;

$readPosts = new read();
$delpost = new posts();
?>
<section class="grid-g-12 estilo-form">
    <h1>Todos os posts.</h1>
    <?php
    $iddelpost = filter_input(INPUT_GET, 'iddelpost', FILTER_VALIDATE_INT);
    if ($iddelpost):
        $delpost->deletaPosts($iddelpost);
    
        if ($delpost->getResultado()):
            echo '<div class="success">' . $delpost->getError() . '<span class="x">X</span></div>';
        else:
            echo '<div class="error">' . $delpost->getError() . '<span class="x">X</span></div>';
            header('refresh: 3; url=index?exe=posts/index');
        endif;
    endif;
    ?>
    <div class="tabela-responsiva">
        <table class="grid-g-12 grid-p-12">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Titulo</th>
                    <th>Descrião</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //LER AS CATEGORIAS.
                $readPosts->ExeRead('posts', "ORDER BY titulo ASC, data_criacao DESC");

                if ($readPosts->getResultado()):
                    foreach ($readPosts->getResultado() as $resPost):
                        ?>
                        <tr>
                            <td><?= $resPost['id'] ?></td>
                            <td><?= $resPost['titulo'] ?></td>
                            <td><?= funcoes::limtarTextos($resPost['conteudo'], 40) ?></td>
                            <td>1</td>                          
                            <td><?= date('d/m/Y H:i', strtotime($resPost['data_criacao'])) ?></td>
                            <td style="text-align: center">
                                <a href="index?exe=posts/update&idpost=<?= $resPost['id'] ?>"><i class="fa fa-edit" style="color: #4280ec; font-size: 17px;"></i></a>
                                <a href="index?exe=posts/index&iddelpost=<?= $resPost['id'] ?>"><i class="fa fa-times" style="color: #e05e5e; font-size: 17px"></i></a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
</section>