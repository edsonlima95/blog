<?php

use app\helper\funcoes;
use app\helper\link;
use app\conn\conn;
use app\conn\read;

//CONTA AS VISITAS.
funcoes::contaVisitas('empresas');

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
            <h2><?= funcoes::limtarTextos($titulo, 100) ?></h2>
            <ul class="descricao-empresa">
                <li>Endereço: <p><?= $endereco ?></p></li>
                <li>Bairro: <p><?= $bairro ?></p></li>
                <?php
                //LER A CIDADE PELO ID
                $readCity = new read();
                $readCity->ExeRead('cidades', "WHERE cidade_id = :id", "id={$cidade}");
                $rescity = $readCity->getResultado()[0]['cidade_nome'];
                ?>
                <li>Cidade: <p><?= $rescity ?></p></li>

                <?php
                //LER O ESTADO PELO ID
                $readEst = clone $readCity;
                $readEst->ExeRead('estados', "WHERE estado_id = :id", "id={$estado}");
                $resestado = $readEst->getResultado()[0]['estado_nome'];
                ?>
                <li>Estado: <p><?= $resestado ?></p></li>
                <li>Contato: <p><?= $contato ?></p></li>
            </ul>
            <p class="conteudo">
                <?= $conteudo ?>
            </p>
            <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($data_criacao)); ?></i></time>
        </div>
        
        <!--BOTAO CURTIR DO FACEBOOK.-->
        <div class="fb-like" data-href="<?=BASE.'empresa/'.$url?>" data-layout="button" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>

        <!--BOTAO COMPARTILHAR DO FACEBOOK.-->
        <div class="fb-share-button" data-href="<?=BASE.'empresa/'.$url?>" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2Fblog%2Fartigo%2Fnome&amp;src=sdkpreparse">Share</a></div>

        
        <!--Galeria.-->
        <h3 class="titulo-galeria">
            <span>Galeria de Imagens</span>
        </h3>
        <?php
        $readGaleria = new read();
        $readGaleria->ExeRead('galeria_empresas', "WHERE id_post  = :id", "id={$id}");
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
            echo '<div class="info">A empresa não contém uma galeria de imagens.</div>';
        endif;
        ?>
        <div class="fb-comments" data-width="100%" data-href="<?=BASE.'artigo/'.$url ?>"></div>
        <article class="relacionados">
            <!--Galeria.-->
            <h3 class="titulo-galeria">
                <span>Veja também</span>
            </h3>
            <?php
            $readRel = new read();
            $readRel->ExeRead('empresas', "WHERE id <> :id AND id_cat = :idc ORDER BY rand() LIMIT 3", "idc={$id_cat}&id={$id}");
            if ($readRel->getResultado()):
                foreach ($readRel->getResultado() as $resE):
                    ?>
                    <div class="grid-g-4" style="word-break: break-all; position: relative">
                        <img src="<?= BASE . 'uploads/' . $resE['capa'] ?>" alt="<?= $resE['titulo'] ?>" title="<?= $resE['titulo'] ?>" style="height: 200px; width: 100%">
                        <a href=""><p class="titulo-rel"><?= funcoes::limtarTextos($resE['titulo'], 70) ?></p></a>
                    </div>
                    <?php
                endforeach;
                else:
                    echo '<div class="info">A empresa não contém empresas relacionadas.</div>';
            endif;
            ?>
        </article>
    </section>
    <!--ASIDE.-->
    <?php require 'inc/aside.php'; ?>
</main>
