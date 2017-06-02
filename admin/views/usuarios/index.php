<?php

use app\helper\funcoes;
use app\conn\read;
use admin\models\usuarios;
use app\helper\paginacao;

$readUser = new read();
$deluser= new usuarios();
?>
<section class="grid-g-12 estilo-form">
    <h1>Todos os usuarios.</h1>
    <?php
    $iddeluser = filter_input(INPUT_GET, 'iddeluser', FILTER_VALIDATE_INT);
    if ($iddeluser):
        $deluser->deletaUsuario($iddeluser);
    
        if ($deluser->getResultado()):
            echo '<div class="success">' . $deluser->getError() . '<span class="x">X</span></div>';
        else:
            echo '<div class="error">' . $deluser->getError() . '<span class="x">X</span></div>';
            header('refresh: 3; url=index.php?exe=usuarios/index');
        endif;
    endif;
    ?>
    <div class="tabela-responsiva">
        <table class="grid-g-12 grid-p-12">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nivel</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $paginacao = new paginacao('http://localhost/blog/admin/index.php?exe=usuarios/index&atual=');
                $valorAtaul = filter_input(INPUT_GET,'atual',FILTER_VALIDATE_INT);
                $paginacao->pagina($valorAtaul, 1);
                
                
                //LER AS USUARIOS.
                $readUser->ExeRead('usuarios', "ORDER BY nome ASC, data_criacao DESC LIMIT :limit OFFSET :offset","limit={$paginacao->getLimit()}&offset={$paginacao->getOffset()}");

                if ($readUser->getResultado()):
                    foreach ($readUser->getResultado() as $resUser):
                        ?>
                        <tr>
                            <td><?= $resUser['id'] ?></td>
                            <td><?= $resUser['nome'] ?></td>
                            <td><?= $resUser['email'] ?></td>
                            <td><?php
                                if($resUser['nivel'] == 1):
                                    echo 'SuperAdmin';
                                else:
                                    echo 'Admin';
                                endif;
                            ?></td>                          
                            <td><?= date('d/m/Y H:i', strtotime($resUser['data_criacao'])) ?></td>
                            <td style="text-align: center">
                                <a href="index.php?exe=usuarios/update&iduser=<?= $resUser['id'] ?>"><i class="fa fa-edit" style="color: #4280ec; font-size: 17px;"></i></a>
                                <a href="index.php?exe=usuarios/index&iddeluser=<?= $resUser['id'] ?>"><i class="fa fa-times" style="color: #e05e5e; font-size: 17px"></i></a>
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
         $paginacao->paginacao('usuarios',"ORDER BY nome ASC, data_criacao DESC");
         echo $paginacao->paginator();
         ?>
    </div>
</section>