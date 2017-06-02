<?php

use app\helper\funcoes;
use app\conn\read;
use admin\models\posts;
use app\helper\paginacao;

$readPosts = new read();
$post = new posts();
?>
<section class="grid-g-12 estilo-form">
    <h1>Todos os posts.</h1>
    <?php
    //Pega o id do post para mudar o status
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);

    switch ($action):
        case 'inativa':
            $post->status($id,0);
            break;
        case 'ativa':
            $post->status($id,1);
            break;
        case 'deletar':
            //Pega o id do post para deleta.
            $iddelpost = filter_input(INPUT_GET, 'iddelpost', FILTER_VALIDATE_INT);
            if ($iddelpost):
                $post->deletaPosts($iddelpost);

                if ($post->getResultado()):
                    echo '<div class="success">' . $post->getError() . '<span class="x">X</span></div>';
                else:
                    echo '<div class="error">' . $post->getError() . '<span class="x">X</span></div>';
                    header('refresh: 3; url=index.php?exe=posts/index');
                endif;
            endif;
            break;
    endswitch;

    
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
                $paginacao = new paginacao('http://localhost/blog/admin/index.php?exe=posts/index&atual=');
                $valorAtaul = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                $paginacao->pagina($valorAtaul, 10);

                //LER AS CATEGORIAS.
                $readPosts->ExeRead('posts', "ORDER BY titulo ASC, data_criacao DESC LIMIT :limit OFFSET :offset", "limit={$paginacao->getLimit()}&offset={$paginacao->getOffset()}");

                if ($readPosts->getResultado()):
                    foreach ($readPosts->getResultado() as $resPost):
                        ?>
                        <tr>
                            <td><?= $resPost['id'] ?></td>
                            <td><?= funcoes::limtarTextos($resPost['titulo'], 40) ?></td>
                            <td><?= funcoes::limtarTextos($resPost['conteudo'], 40) ?></td>
                            <td style="text-align: center"><a href="#">
                                    <?php
                                    if ($resPost['status'] == 1):
                                        echo'<a href="index.php?exe=posts/index&action=inativa&id=' . $resPost['id'] . '" title="ativo"><i class="fa fa-check" style="color: #1fe01f;"></i></a>';
                                    else:
                                        echo'<a href="index.php?exe=posts/index&action=ativa&id=' . $resPost['id'] . '" title="inativo"><i class="fa fa-ban" style="color: red;"></i></a>';
                                    endif;
                                    ?>

                            </td>                          
                            <td><?= date('d/m/Y H:i', strtotime($resPost['data_criacao'])) ?></td>
                            <td style="text-align: center">
                                <a href="index.php?exe=posts/update&idpost=<?= $resPost['id'] ?>"><i class="fa fa-edit" style="color: #4280ec; font-size: 17px;"></i></a>
                                <a href="index.php?exe=posts/index&action=deletar&iddelpost=<?= $resPost['id'] ?>"><i class="fa fa-times" style="color: #e05e5e; font-size: 17px"></i></a>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <?php
        $paginacao->paginacao('posts', "ORDER BY titulo ASC, data_criacao DESC");
        echo $paginacao->paginator();
        ?>
    </div>
</section>