<?php

use app\conn\read;
use app\helper\funcoes;

$read = new read();

//POSTS
$read->ExeRead('posts');
$numposts = $read->getRowCount();

//CATEGORIAS.
$read->ExeRead('categorias');
$numcategoria = $read->getRowCount();

//EMPRESAS
$read->ExeRead('empresas');
$numempresas = $read->getRowCount();

//USUARIOS
$read->ExeRead('usuarios');
$numusuarios = $read->getRowCount();

//CONTA TODAS AS VISITAS.
$read->executeQuery('SELECT SUM(quan_visitas) AS visitas FROM site_visitas');
$visitas = $read->getResultado()[0]['visitas'];

//CONTA TODAS AS PAGINAS VISITADAS.
$read->executeQuery('SELECT SUM(visitas_paginas) AS visitaspag FROM site_visitas');
$visitasPag = $read->getResultado()[0]['visitaspag'];


?>
<section class="grid-g-12 grid-m-12 admin">
    <h1>Estatisticas</h1>
    <article class="grid-g-3 grid-m-4"><i class="fa fa-users fa-3x"></i><p>Usuários <?=$numusuarios?></p></article>
    <article class="grid-g-3 grid-m-4" style="background: #289dcc"><i class="fa fa-edit fa-3x"></i><p>Posts <?= $numposts ?></p></article>
    <article class="grid-g-3 grid-m-4" style="background: #777fce"><i class="fa fa-list-alt fa-3x"></i><p>Categorias <?=$numcategoria?></p></article>
    <article class="grid-g-3 grid-m-4" style="background: #bd4cce"><i class="fa fa-eye fa-3x"></i><p>Visitas <?=$visitas?></p></article>
    <article class="grid-g-3 grid-m-4" style="background: #dd5a5a"><i class="fa fa-eye fa-3x"></i><p>V. Páginas <?=$visitasPag?></p></article>
    <article class="grid-g-3 grid-m-4" style="background: #bd0707"><i class="fa fa-building-o fa-3x"></i><p>Empresas <?=$numempresas?></p></article>
</section>
<section class="grid-g-4" style="padding: 5px">

</section>
<section class="grid-g-8 artigos">
    <div class="grid-g-6 grid-m-6 grid-p-12" style="margin-right: 10px">
        <span class="titulo">Posts recentes</span>
        <?php
        $readPostsRecents = new read();
        $readPostsRecents->ExeRead('posts', "ORDER BY data_criacao DESC LIMIT 10");

        foreach ($readPostsRecents->getResultado() as $resPosts):
            ?>
            <div class="grid-g-4 bloco-img">
                <img src="<?php if($resPosts['capa']) echo BASE.'uploads/'.$resPosts['capa']; 
                else echo '../uploads/posts/posts-default.png'; ?>" width="100%" height="78">
            </div>
            <div class="grid-g-8 bloco-conteudo">
                <h1><a href="#"><?= funcoes::limtarTextos($resPosts['titulo'], 40) ?></a></h1>   
                <ul class="acoes">
                    <li><a href="<?= BASE.'artigo/'.$resPosts['url'] ?>"><i class="fa fa-eye"></i></a></li>
                    <li><a href="index.php?exe=posts/update&idpost=<?= $resPosts['id'] ?>"><i class="fa fa-edit"></i></a></li>
                    <li><a href="index.php?exe=posts/index&action=deletar&iddelpost=<?= $resPosts['id'] ?>"><i class="fa fa-times"></i></a></li>
                </ul>
            </div>
            <?php
        endforeach;
        ?>
    </div>
    <div class="grid-g-6 grid-m-6 grid-p-12 bloco-with">
        <span class="titulo">Empresas recentes</span>
        <?php
        $readEmpRecents = new read();
        $readEmpRecents->ExeRead('empresas', "ORDER BY data_criacao DESC LIMIT 10");

        foreach ($readEmpRecents->getResultado() as $resEmps):
            ?>
            <div class="grid-g-4 bloco-img">
                <img src="<?php if($resEmps['capa']) echo BASE.'uploads/'.$resEmps['capa']; 
                else echo '../uploads/empresas/empresas-default.jpg'; ?>" width="100%" height="78">
            </div>
            <div class="grid-g-8 bloco-conteudo">
                <h1><a href="#"><?= $resEmps['titulo'] ?></a></h1> 
                <ul class="acoes">
                    <li><a href="<?=BASE.'empresa/'.$resEmps['url'] ?>"><i class="fa fa-eye"></i></a></li>
                    <li><a href="index.php?exe=empresas/update&idemp=<?= $resEmps['id'] ?>"><i class="fa fa-edit"></i></a></li>
                    <li><a href="index.php?exe=empresas/index&iddelemp=<?= $resEmps['id'] ?>"><i class="fa fa-times"></i></a></li>
                </ul>
            </div>
            <?php
        endforeach;
        ?>
    </div>
</section>