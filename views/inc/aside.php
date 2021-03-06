<?php

use app\helper\funcoes;
use app\conn\read;
?>
<aside class="grid-g-4 grid-m-12  conteudo-direito">

    <section class="grid-g-12 grid-m-6">
        <h3>
            <span>Top 5 posts mais vistos.</span>
        </h3>
        <?php
        $readTopPosts = new read();
        $readTopPosts->ExeRead('posts', "ORDER BY visitas DESC LIMIT 5");

        foreach ($readTopPosts->getResultado() as $resTopp):
            ?>
            <div class="grid-g-3 grid-m-3">
                <a href="<?= BASE . 'artigo/' . $resTopp['url']; ?>"><img src="<?= BASE . 'uploads/' . $resTopp['capa']; ?>" alt="<?= $resTopp['titulo']; ?>" title="<?= $resTopp['titulo']; ?>"></a>
            </div>
            <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                <h1><a href="<?= BASE . 'artigo/' . $resTopp['url']; ?>"><?= funcoes::limtarTextos($resTopp['titulo'], 50) ?></a></h1>
                <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($resTopp['data_criacao'])) ?></i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas <?= $resTopp['visitas']; ?></i></p>
            </div>
            <?php
        endforeach;
        ?>
    </section>

    <section class="top-empresas grid-g-12 grid-m-6">
        <h3>
            <span>Top 5 empresas mais vistas</span>
        </h3>
        <?php
        $readE = new read();
        $readE->ExeRead('empresas', "WHERE status = 1 ORDER BY visitas DESC LIMIT 5");
        foreach ($readE->getResultado() as $resE):
            ?>
            <div class="grid-g-3 grid-m-3">
                <a href="<?= BASE . 'empresa/' . $resE['url'] ?>"><img src="<?= BASE . 'uploads/' . $resE['capa'] ?>" alt="<?= $resE['titulo'] ?>" title="<?= $resE['titulo'] ?>"></a>
            </div>
            <div class="grid-g-9 grid-m-9 bloco2-conteudo" style="padding-bottom: 33px">
                <h1><a href="<?= BASE . 'empresa/' . $resE['url'] ?>"><?= funcoes::limtarTextos($resE['titulo'], 100) ?></a></h1>
                <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($resE['data_criacao'])) ?></i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas <?= $resE['visitas'] ?></i></p>
            </div>
            <?php
        endforeach;
        ?>
    </section>
    <section class="grid-g-12 grid-m-6">
        <h3>
            <span>Nossos parceiros</span>
        </h3>
        <div class="grid-g-12">
            <?php
            $readPub = new read();
            $readPub->ExeRead('publicidades', "ORDER BY data_criacao DESC LIMIT 5");
            foreach ($readPub->getResultado() as $resPub):
                ?>
            <figure>
                <img src="<?= BASE . 'uploads/' . $resPub['caminho'] ?>" alt="<?= $resPub['nome'] ?>" title="<?= $resPub['nome'] ?>" style="margin: 0 0 5px 0; height: 160px">
            </figure>
                <?php
            endforeach;
            ?>
        </div>
    </section>
</aside>