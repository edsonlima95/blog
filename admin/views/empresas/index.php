<?php

use app\helper\funcoes;
use app\conn\read;
use admin\models\empresa;
use app\helper\paginacao;

$readEmpresas = new read();
$delempresa = new empresa();
?>
<section class="grid-g-12 estilo-form">
    <h1>Todos os posts.</h1>
    <?php
    $iddelpost = filter_input(INPUT_GET, 'iddelemp', FILTER_VALIDATE_INT);
    if ($iddelpost):
        $delempresa->deletaEmpresa($iddelpost);
    
        if ($delempresa->getResultado()):
            echo '<div class="success">' . $delempresa->getError() . '<span class="x">X</span></div>';
        else:
            echo '<div class="error">' . $delempresa->getError() . '<span class="x">X</span></div>';
            header('refresh: 3; url=index.php?exe=posts/index');
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
                //PAGINAÇÃO.
                $paginacao = new paginacao('http://localhost/blog/admin/index.php?exe=empresas/index&atual=');
                $valorAtaul = filter_input(INPUT_GET,'atual',FILTER_VALIDATE_INT);
                $paginacao->pagina($valorAtaul, 1);
                
                //LER AS CATEGORIAS.
                $readEmpresas->ExeRead('empresas', "ORDER BY titulo ASC, data_criacao DESC LIMIT :limit OFFSET :offset","limit={$paginacao->getLimit()}&offset={$paginacao->getOffset()}");

                if ($readEmpresas->getResultado()):
                    foreach ($readEmpresas->getResultado() as $resEmp):
                        ?>
                        <tr>
                            <td><?= $resEmp['id'] ?></td>
                            <td><?= $resEmp['titulo'] ?></td>
                            <td><?= funcoes::limtarTextos($resEmp['conteudo'], 40) ?></td>
                            <td>1</td>                          
                            <td><?= date('d/m/Y H:i', strtotime($resEmp['data_criacao'])) ?></td>
                            <td style="text-align: center">
                                <a href="index.php?exe=empresas/update&idemp=<?= $resEmp['id'] ?>"><i class="fa fa-edit" style="color: #4280ec; font-size: 17px;"></i></a>
                                <a href="index.php?exe=empresas/index&iddelemp=<?= $resEmp['id'] ?>"><i class="fa fa-times" style="color: #e05e5e; font-size: 17px"></i></a>
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
            $paginacao->paginacao('empresas', "ORDER BY titulo ASC, data_criacao DESC");
            echo $paginacao->paginator();
        ?>
    </div>
</section>