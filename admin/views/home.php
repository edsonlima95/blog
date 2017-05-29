<?php

use app\conn\read;
use app\helper\funcoes;
?>
<section class="grid-g-12 grid-m-12 admin">
    <h1>Estatisticas</h1>
    <article class="grid-g-3 grid-m-4"><i class="fa fa-users fa-3x"></i><p>Usuários 15000</p></article>
    <article class="grid-g-3 grid-m-4" style="background: #289dcc"><i class="fa fa-edit fa-3x"></i><p>Posts 5000</p></article>
    <article class="grid-g-3 grid-m-4" style="background: #777fce"><i class="fa fa-list-alt fa-3x"></i><p>Categorias 5000</p></article>
    <article class="grid-g-3 grid-m-4" style="background: #bd4cce"><i class="fa fa-eye fa-3x"></i><p>Visitas 5000</p></article>
    <article class="grid-g-3 grid-m-4" style="background: #dd5a5a"><i class="fa fa-eye fa-3x"></i><p>V. Páginas 5000</p></article>
    <article class="grid-g-3 grid-m-4" style="background: #bd0707"><i class="fa fa-building-o fa-3x"></i><p>Empresas 5000</p></article>
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
                <img src="<?php if($resPosts['capa']) echo 'http://localhost/blog/uploads/'.$resPosts['capa']; 
                else echo '../uploads/posts/posts-default.png'; ?>" width="100%" height="78">
            </div>
            <div class="grid-g-8 bloco-conteudo">
                <h1><a href="#"><?= funcoes::limtarTextos($resPosts['titulo'], 40) ?></a></h1>   
                <ul class="acoes">
                    <li><a href="http://localhost/blog/artigo/<?= $resPosts['url'] ?>"><i class="fa fa-eye"></i></a></li>
                    <li><a href="index.php?exe=posts/update&idpost=<?= $resPosts['id'] ?>"><i class="fa fa-edit"></i></a></li>
                    <li><a href="index.php?exe=posts/index&iddelpost=<?= $resPosts['id'] ?>"><i class="fa fa-times"></i></a></li>
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
                <img src="<?php if($resEmps['capa']) echo 'http://localhost/blog/uploads/'.$resEmps['capa']; 
                else echo '../uploads/empresas/empresas-default.jpg'; ?>" width="100%" height="78">
            </div>
            <div class="grid-g-8 bloco-conteudo">
                <h1><a href="#">Titulo do post que sera exibido aqui</a></h1>   
                <ul class="acoes">
                    <li><a href="http://localhost/blog/artigo/<?= $resEmps['url'] ?>"><i class="fa fa-eye"></i></a></li>
                    <li><a href="index.php?exe=empresas/update&idemp=<?= $resEmps['id'] ?>"><i class="fa fa-edit"></i></a></li>
                    <li><a href="index.php?exe=empresas/index&iddelemp=<?= $resEmps['id'] ?>"><i class="fa fa-times"></i></a></li>
                </ul>
            </div>
            <?php
        endforeach;
        ?>
    </div>
</section>