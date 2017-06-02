<?php
use app\helper\funcoes;
use app\helper\link;
use app\conn\conn;
use app\conn\read;

//CONTA AS VISITAS.
funcoes::contaVisitas('posts');

$link = new link();
$link->getTags();

if($link->getDados()):
    extract($link->getDados());    
endif;

?>
<main class="grid-g-12">
    <section class="grid-g-8 conteudo-esquerdo artigo">  
            <h1><?= $titulo ?></h1>
             <!--Artigo.-->
            <img src="http://localhost/blog/uploads/<?= $capa ?>" alt="<?= $titulo ?>" title="<?= $titulo ?>">
            <div class="artigo-conteudo">
                <p class="conteudo">
                    <?= $conteudo ?>
                </p>
                <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($data_criacao)); ?></i></time>
                <i class="fa fa-user criador"> <?= $autor ?></i>
            </div>
            <!--Galeria.-->
            <h3 class="titulo-galeria">
                <span>Galeria de Imagens</span>
            </h3>
            <?php
            $readGaleria = new read();
            $readGaleria->ExeRead('galeria_posts',"WHERE id_post  = :id","id={$id}");
            if($readGaleria->getResultado()):
                foreach ($readGaleria->getResultado() as $resArt):
            ?>
            <div class="grid-g-3 galeria">
                <a href="<?= BASE.'uploads/'.$resArt['caminho'] ?>" rel="shadowbox[id]">
                    <img src="<?= BASE.'uploads/'.$resArt['caminho'] ?>" alt="<?= $resArt['titulo']?>" title="<?= $resArt['titulo']?>" height="170px">
                </a>
            </div>
            <?php
                endforeach;
            else:
                echo '<div class="info">O post não contém uma galeria de imagens.</div>';
            endif;
            ?>
    </section>
    
    <!--ASIDE.-->
    <?php require 'inc/aside.php';?>
</main>

