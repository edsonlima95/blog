<?php

use app\helper\funcoes;
use app\conn\read;
use admin\models\empresas;

$readEmpresas = new read();
$delemp = new empresas();

?>
<section class="grid-g-12 estilo-form">
    <h1>Todas as categorias.</h1>
    <?php
    $idemp = filter_input(INPUT_GET, 'idempdel', FILTER_VALIDATE_INT);
    if (isset($idemp)):
        $delemp->deletaEmpresa($idemp);
        if ($delemp->getResultado()):
            echo '<div class="success">' . $delemp->getError() . '<span class="x">X</span></div>';
        else:
            echo '<div class="error">' . $delemp->getError() . '<span class="x">X</span></div>';
            header('refresh: 3; url=index?exe=empresas_cat/index');
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
                    <th>Empresas</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //LER AS CATEGORIAS.
                $readEmpresas->ExeRead('categoria_empresas', "ORDER BY titulo ASC, data_criacao DESC");

                if ($readEmpresas->getResultado()):
                    foreach ($readEmpresas->getResultado() as $catEmp):
                        //CONTA AS EMPRESAS CADASTRADAS NA CATEGORIA.
                        $readCout = new read();
                        $readCout->ExeRead('empresas',"WHERE id_cat = :id","id={$catEmp['id']}");
                        $countEmp = $readCout->getRowCount();
                        ?>
                        <tr>
                            <td><?= $catEmp['id'] ?></td>
                            <td><?= $catEmp['titulo'] ?></td>
                            <td><?= funcoes::limtarTextos($catEmp['conteudo'], 50) ?></td>         
                            <td><?=$countEmp?></td>
                            <td><?= date('d/m/Y H:i', strtotime($catEmp['data_criacao'])) ?></td>
                            <td style="text-align: center">
                                <a href="index?exe=empresas_cat/update&idemp=<?= $catEmp['id'] ?>"><i class="fa fa-edit" style="color: #4280ec; font-size: 17px;"></i></a>
                                <a href="index?exe=empresas_cat/index&idempdel=<?= $catEmp['id'] ?>"><i class="fa fa-times" style="color: #e05e5e; font-size: 17px"></i></a>
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