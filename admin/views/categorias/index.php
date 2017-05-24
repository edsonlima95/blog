<?php

use app\helper\funcoes;
use app\conn\read;
use admin\models\categorias;

$readCategoria = new read();
$delcat = new categorias();
$readSubCount = clone $readCategoria;
$readCategoriaSub = clone $readCategoria;
?>
<section class="grid-g-12 estilo-form">
    <h1>Todas as categorias.</h1>
    <?php
    $iddel = filter_input(INPUT_GET, 'iddel', FILTER_VALIDATE_INT);
    if (isset($iddel)):
        $delcat->deletaCategoria($iddel);
        if ($delcat->getResultado()):
            echo '<div class="success">' . $delcat->getError() . '<span class="x">X</span></div>';
        else:
            echo '<div class="error">' . $delcat->getError() . '<span class="x">X</span></div>';
            header('refresh: 3; url=index?exe=categorias/index');
        endif;
    endif;
    ?>
    <div class="tabela-responsiva">
        <table class="grid-g-12 grid-p-12">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nome</th>
                    <th>Titulo</th>
                    <th>Descrião</th>
                    <th>Sub-categorias</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //LER AS CATEGORIAS.
                $readCategoria->ExeRead('categorias', "WHERE id_pai IS NULL ORDER BY titulo ASC, data_criacao DESC");

                if ($readCategoria->getResultado()):
                    foreach ($readCategoria->getResultado() as $catPai):
                        $readSubCount->ExeRead('categorias', "WHERE id_pai = :id", "id={$catPai['id']}");
                        $countSub = count($readSubCount->getResultado());
                        ?>
                        <tr class="row-cat">
                            <td><?= $catPai['id'] ?></td>
                            <td><?= $catPai['nome'] ?></td>
                            <td><?= $catPai['titulo'] ?></td>
                            <td><?= funcoes::limtarTextos($catPai['conteudo'], 40) ?></td>
                            <td><?= $countSub ?></td>                          
                            <td><?= date('d/m/Y H:i', strtotime($catPai['data_criacao'])) ?></td>
                            <td style="text-align: center">
                                <a href="index?exe=categorias/update&idcat=<?= $catPai['id'] ?>"><i class="fa fa-edit" style="color: #4280ec; font-size: 17px;"></i></a>
                                <a href="index?exe=categorias/index&iddel=<?= $catPai['id'] ?>"><i class="fa fa-times" style="color: #e05e5e; font-size: 17px"></i></a>
                            </td>
                        </tr>
                        <?php
                        $readCategoriaSub->ExeRead('categorias', "WHERE id_pai = :id ORDER BY data_criacao DESC", "id={$catPai['id']}");

                        if ($readCategoriaSub->getResultado()):
                            foreach ($readCategoriaSub->getResultado() as $catSub):
                                ?>
                                <tr>
                                    <td><?= $catSub['id'] ?></td>
                                    <td><?= $catSub['nome'] ?></td>
                                    <td><?= $catSub['titulo'] ?></td>
                                    <td><?= funcoes::limtarTextos($catSub['conteudo'], 40) ?></td>
                                    <td>--</td>                          
                                    <td><?= date('d/m/Y H:i', strtotime($catSub['data_criacao'])) ?></td>
                                    <td style="text-align: center">
                                        <a href="index?exe=categorias/update&idcat=<?= $catSub['id'] ?>"><i class="fa fa-edit" style="color: #4280ec; font-size: 17px;"></i></a>
                                        <a href="index?exe=categorias/index&iddel=<?= $catSub['id'] ?>"><i class="fa fa-times" style="color: #e05e5e; font-size: 17px"></i></a>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
</section>