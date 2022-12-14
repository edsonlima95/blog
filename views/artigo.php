<?php

use app\helper\funcoes;
use app\helper\link;
use app\conn\conn;
use app\conn\read;

//CONTA AS VISITAS.
funcoes::contaVisitas('posts');

$link = new link();
$link->getTags();

if ($link->getDados()):
    extract($link->getDados());
endif;
?>
<main class="grid-g-12">
    <section class="grid-g-8 conteudo-esquerdo artigo">  
        <h1><?= $titulo ?></h1>
        <!--Artigo.-->
        <img src="<?= BASE . 'uploads/' . $capa ?>" alt="<?= $titulo ?>" title="<?= $titulo ?>">
        <div class="artigo-conteudo">
            <p class="conteudo">
                <?= $conteudo ?>
            </p>
            <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($data_criacao)); ?></i></time>
            <i class="fa fa-user criador"> <?= $autor ?></i>
        </div>

        <!--BOTAO CURTIR DO FACEBOOK.-->
        <div class="fb-like" data-href="<?=BASE.'artigo/'.$url?>" data-layout="button" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>

        <!--BOTAO COMPARTILHAR DO FACEBOOK.-->
        <div class="fb-share-button" data-href="<?=BASE.'artigo/'.$url?>" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2Fblog%2Fartigo%2Fnome&amp;src=sdkpreparse">Share</a></div>

        <!--Galeria.-->
        <h3 class="titulo-galeria">
            <span>Galeria de Imagens</span>
        </h3>
        <?php
        $readGaleria = new read();
        $readGaleria->ExeRead('galeria_posts', "WHERE id_post  = :id", "id={$id}");
        if ($readGaleria->getResultado()):
            foreach ($readGaleria->getResultado() as $resArt):
                ?>
                <div class="grid-g-3 galeria">
                    <a href="<?= BASE . 'uploads/' . $resArt['caminho'] ?>" rel="shadowbox[id]">
                        <img src="<?= BASE . 'uploads/' . $resArt['caminho'] ?>" alt="<?= $resArt['titulo'] ?>" title="<?= $resArt['titulo'] ?>" height="170px">
                    </a>
                </div>
                <?php
            endforeach;
        else:
            echo '<div class="info">O post n??o cont??m uma galeria de imagens.</div>';
        endif;
        ?>
        <!--BOTAO COMENTARIOS.-->
        <div class="fb-comments" data-width="100%" data-href="<?= BASE . 'artigo/' . $url ?>"></div>
        
        <article class="relacionados">
            <!--Galeria.-->
            <h3 class="titulo-galeria">
                <span>Veja tamb??m</span>
            </h3>
            <?php
            $readRel = new read();
            $readRel->ExeRead('posts', "WHERE id <> :id AND id_sub = :ids ORDER BY rand() LIMIT 3", "ids={$id_sub}&id={$id}");
            if ($readRel->getResultado()):
                foreach ($readRel->getResultado() as $resRel):
                    ?>
                    <div class="grid-g-4" style="word-break: break-all; position: relative">
                        <img src="<?= BASE . 'uploads/' . $resRel['capa'] ?>" alt="<?= $resRel['titulo'] ?>" title="<?= $resRel['titulo'] ?>" style="height: 200px">
                        <a href=""><p class="titulo-rel"><?= funcoes::limtarTextos($resRel['titulo'], 70) ?></p></a>
                    </div>
                    <?php
                endforeach;
            else:
                echo '<div class="info">O post n??o cont??m posts relacionados.</div>';
            endif;
            ?>
        </article>
    </section>

    <!--ASIDE.-->
    <?php require 'inc/aside.php'; ?>
</main>

