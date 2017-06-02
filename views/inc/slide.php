<?php

use app\conn\read;
use app\helper\funcoes;
?>
<section id="slide-noticia" class="grid-g-12">
    <div class="grid-g-6 slide">
        <div id="wowslider-container1">
            <div class="ws_images">
                <ul>
                    <?php
                    //id da categoria.
                    $idcat = funcoes::categoriaNome('noticias');

                    $readPostsGeral = new read();
                    $readPostsGeral->ExeRead('posts', "WHERE status = 1 AND id_cat = :id ORDER BY data_criacao DESC LIMIT :limit OFFSET :offset", "id={$idcat}&limit=3&offset=0");
                    foreach ($readPostsGeral->getResultado() as $resNot):
                        extract($resNot);
                        ?>
                        <li>
                            <a href="<?= BASE ?>artigo/<?= $url ?>"><img src="<?= BASE . 'uploads/' . $capa ?>" alt="<?php $titulo ?>" title="<?php $titulo ?>" id="wows1_0"/></a>
                            <a href="<?= BASE ?>artigo/<?= $url ?>"><h1><?= funcoes::limtarTextos($titulo, 50) ?></h1></a>
                            <a href="#"><p><?= funcoes::limtarTextos($conteudo, 100) ?></a></p></a>
                        </li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <section class="grid-g-6 box-noticias-slide">
        <?php
        $readPostsGeral->setPlaces("id={$idcat}&limit=4&offset=3");
        $result = $readPostsGeral->getResultado();
        foreach ($result as $res4):
            ?>
            <article class="grid-g-6 grid-m-4 grid-p-12 noticias-do-slide"> 
                <a href="artigo/<?= $res4['url'] ?>"><img src="<?= BASE . 'uploads/' . $res4['capa']; ?>" alt="<?= $res4['titulo'] ?>" title="<?= $res4['titulo'] ?>"></a>
                <div class="conteudo-noticias">
                    <h1><a href="artigo/<?= $res4['url'] ?>"><?= funcoes::limtarTextos($res4['titulo'], 25) ?></a></h1>
                    <time><i class="fa fa-calendar"> <?= $res4['data_criacao'] ?></i></time>
                    <p class="criado" style="font-size: 10px"><i class="fa fa-eye"> Visitas <?= $res4['visitas'] ?></i></p>
                </div>
            </article>
            <?php
        endforeach;
        ?>
    </section>
</section>