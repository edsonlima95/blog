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
    </section>

    <!--ASIDE.-->
    <?php require 'inc/aside.php'; ?>

</main>
