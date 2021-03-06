<?php

use app\helper\funcoes;
use app\conn\read;
use admin\models\categorias;
use app\helper\paginacao;

//OBJETOS
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
            header('refresh: 3; url=index.php?exe=categorias/index');
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
                $paginacao = new paginacao(BASE.'admin/index.php?exe=categorias/index&atual=');
                $valorAtaul = filter_input(INPUT_GET,'atual',FILTER_VALIDATE_INT);
                $paginacao->pagina($valorAtaul, 5);
                
                //LER AS CATEGORIAS.
                $readCategoria->ExeRead('categorias', "WHERE id_pai IS NULL ORDER BY nome ASC, data_criacao DESC LIMIT :limit OFFSET :offset","limit={$paginacao->getLimit()}&offset={$paginacao->getOffset()}");

                if ($readCategoria->getResultado()):
                    foreach ($readCategoria->getResultado() as $catPai):
                        $readSubCount->ExeRead('categorias', "WHERE id_pai = :id", "id={$catPai['id']}");
                        $countSub = count($readSubCount->getResultado());
                        ?>
                       <tr class="row-cat" id="<?= $catPai['id'] ?>">
                            <td><?= $catPai['id'] ?></td>
                            <td><?= $catPai['nome'] ?></td>
                            <td><?= funcoes::limtarTextos($catPai['titulo'],30); ?></td>
                            <td><?= funcoes::limtarTextos($catPai['conteudo'], 30) ?></td>
                            <td><?= $countSub ?></td>                          
                            <td><?= date('d/m/Y H:i', strtotime($catPai['data_criacao'])) ?></td>
                            <td style="text-align: center">
                                <a href="index.php?exe=categorias/update&idcat=<?= $catPai['id'] ?>"><i class="fa fa-edit" style="color: #4280ec; font-size: 17px;"></i></a>
                                <a href="index.php?exe=categorias/index&iddel=<?= $catPai['id'] ?>"><i class="fa fa-times" style="color: #e05e5e; font-size: 17px"></i></a>
                            </td>
                        </tr>
                        <?php
                        $readCategoriaSub->ExeRead('categorias', "WHERE id_pai = :id ORDER BY data_criacao DESC", "id={$catPai['id']}");

                        if ($readCategoriaSub->getResultado()):
                            foreach ($readCategoriaSub->getResultado() as $catSub):
                                ?>
                                <tr class="sub-cat-tabela">
                                    <td id="<?=$catSub['id_pai']?>"><?= $catSub['id'] ?></td>
                                    <td id="<?=$catSub['id_pai']?>"><?= $catSub['nome'] ?></td>
                                    <td id="<?=$catSub['id_pai']?>"><?= $catSub['titulo'] ?></td>
                                    <td id="<?=$catSub['id_pai']?>"><?= funcoes::limtarTextos($catSub['conteudo'], 40) ?></td>
                                    <td id="<?=$catSub['id_pai']?>">--</td>                          
                                    <td id="<?=$catSub['id_pai']?>"><?= date('d/m/Y H:i', strtotime($catSub['data_criacao'])) ?></td>
                                    <td style="text-align: center" id="<?=$catSub['id_pai']?>">
                                        <a href="index.php?exe=categorias/update&idcat=<?= $catSub['id'] ?>"><i class="fa fa-edit" style="color: #4280ec; font-size: 17px;"></i></a>
                                        <a href="index.php?exe=categorias/index&iddel=<?= $catSub['id'] ?>"><i class="fa fa-times" style="color: #e05e5e; font-size: 17px"></i></a>
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
    <div class="paginator">
        <?php
        $paginacao->paginacao('categorias',"WHERE id_pai IS NULL ORDER BY titulo ASC, data_criacao DESC ");
        echo $paginacao->paginator();
        ?>
    </div>
</section>