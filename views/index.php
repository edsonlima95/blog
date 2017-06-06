<?php
require 'inc/slide.php';

use app\helper\funcoes;
use app\conn\read;

$read = new read();
?>
<main class="grid-g-12">
    <section class="grid-g-8 conteudo-esquerdo">  
        <?php
        $idcat = funcoes::categoriaNome('entretenimento');
        $read->ExeRead('posts', "WHERE status = 1 AND id_cat = :idc ORDER BY data_criacao DESC LIMIT :limit OFFSET :offset", "idc={$idcat}&limit=1&offset=0");
        $res = $read->getResultado()[0];
        ?>
        <h3>
            <span>ENTRETENIMENTO</span>
        </h3>
        <!--CATEGORIAS 1.-->

        <div class="grid-g-6 grid-m-6 bloco1">
            <a href="artigo/"><img src="<?= BASE . 'uploads/' . $res['capa'] ?>" alt="<?= $res['titulo'] ?>" title="<?= $res['titulo'] ?>" ></a>
            <div class="bloco1-conteudo">
                <h1><a href="<?= BASE . 'artigo/' . $res['url'] ?>"><?= funcoes::limtarTextos($res['titulo'], 50) ?></a></h1>
                <p> <?= funcoes::limtarTextos($res['conteudo'], 200) ?></p>
                <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($res['data_criacao'])) ?></i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas <?= $res['visitas'] ?></i></p>
            </div>
        </div>

        <div class="grid-g-6 grid-m-6 bloco2" >
            <?php
            $read->setPlaces("idc={$idcat}&limit=4&offset=1");
            foreach ($read->getResultado() as $res2):
                ?>
                <div class="grid-g-3 grid-m-3">
                    <a href="artigo/<?= $res2['url'] ?>"><img src="<?= BASE . 'uploads/' . $res2['capa'] ?>" alt="<?= $res2['titulo'] ?>" title="<?= $res2['titulo'] ?>"></a>
                </div>
                <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                    <h1><a href="artigo/<?= $res2['url'] ?>"><?= funcoes::limtarTextos($res2['titulo'], 50) ?></a></h1>
                    <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($res['data_criacao'])) ?></i></time>
                    <p class="criado"><i class="fa fa-eye"> Visitas <?= $res2['visitas'] ?></i></p>
                </div>
                <?php
            endforeach;
            ?>
        </div>


        <!--CATEGORIAS 2 .--> 
        <div class="grid-g-6 grid-m-6 bloco1 cat2">
            <?php
            $idcat2 = funcoes::categoriaNome('tecnologia');
            $read->ExeRead('posts', "WHERE status = 1 AND id_cat = :idc ORDER BY data_criacao DESC LIMIT :limit OFFSET :offset", "idc={$idcat2}&limit=1&offset=0");
            $resTec = $read->getResultado()[0];
            ?>
            <h3 class="titulo-cat2">
                <span>TECNOLOGIA</span>
            </h3>
            <a href="<?= BASE . 'artigo/' . $resTec['url'] ?>"><img src="<?= BASE . 'uploads/' . $resTec['capa'] ?>" alt="<?= $resTec['titulo'] ?>" title="<?= $resTec['titulo'] ?>" ></a>
            <div class="bloco1-conteudo">
                <h1><a href="<?= BASE . 'artigo/' . $resTec['url'] ?>"><?= funcoes::limtarTextos($resTec['titulo'], 50) ?></a></h1>
                <p>
                    <?= funcoes::limtarTextos($resTec['conteudo'], 90) ?>   
                </p>
                <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($resTec['data_criacao'])) ?></i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas <?= $resTec['visitas'] ?></i></p>
            </div>
        </div>


        <!--CATEGORIA 3.-->
        <div class="grid-g-6 grid-m-6 bloco1 cat3">
            <?php
            $idcat3 = funcoes::categoriaNome('esportes');
            $read->ExeRead('posts', "WHERE status = 1 AND id_cat = :idc ORDER BY data_criacao DESC LIMIT :limit OFFSET :offset", "idc={$idcat3}&limit=1&offset=0");
            $resEsp = $read->getResultado()[0];
            ?>
            <h3 class="titulo-cat3">
                <span>ESPORTES</span>
            </h3>
            <a href="<?= BASE . 'artigo/' . $resEsp['url'] ?>"><img src="<?= BASE . 'uploads/' . $resEsp['capa'] ?>" alt="<?= $resEsp['titulo'] ?>" title="<?= $resEsp['titulo'] ?>"></a>
            <div class="bloco1-conteudo">
                <h1><a href="<?= BASE . 'artigo/' . $resEsp['url'] ?>"><?= funcoes::limtarTextos($resEsp['titulo'], 50) ?></a></h1>
                <p>
                    <?= funcoes::limtarTextos($resEsp['conteudo'], 90) ?>  
                </p>
                <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($resEsp['data_criacao'])) ?></i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas <?= $resEsp['visitas'] ?></i></p>
            </div>
        </div>

        <!--3 aritgos categoria 2.-->
        <div class="grid-g-6 grid-m-6 bloco2 art3">
            <?php
            $read->setPlaces("idc={$idcat2}&limit=3&offset=1");
            foreach ($read->getResultado() as $restec2):
                ?>
                <div class="grid-g-3 grid-m-3">
                    <a href="<?= BASE . 'artigo/' . $restec2['url'] ?>"><img src="<?= BASE . 'uploads/' . $restec2['capa'] ?>" alt="<?= $restec2['titulo'] ?>" title="<?= $restec2['titulo'] ?>"></a>
                </div>
                <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                    <h1><a href="<?= BASE . 'artigo/' . $restec2['url'] ?>"><?= funcoes::limtarTextos($restec2['titulo'], 50) ?></a></h1>
                    <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($restec2['data_criacao'])) ?></i></time>
                    <p class="criado"><i class="fa fa-eye"> Visitas <?= $restec2['visitas'] ?></i></p>
                </div>
                <?php
            endforeach;
            ?>
        </div>

        <!--3 aritgos categoria 3.-->
        <div class="grid-g-6 grid-m-6 bloco2 art4">
            <?php
            $read->setPlaces("idc={$idcat3}&limit=3&offset=1");
            foreach ($read->getResultado() as $resesp3):
                ?>
                <div class="grid-g-3 grid-m-3">
                    <a href="<?= BASE . 'artigo/' . $resesp3['url'] ?>"><img src="<?= BASE . 'uploads/' . $resesp3['capa'] ?>" alt="<?= $resesp3['titulo'] ?>" title="<?= $resesp3['titulo'] ?>"></a>
                </div>
                <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                    <h1><a href="<?= BASE . 'artigo/' . $resesp3['url'] ?>"><?= funcoes::limtarTextos($resesp3['titulo'], 50) ?></a></h1>
                    <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($resesp3['data_criacao'])) ?></i></time>
                    <p class="criado"><i class="fa fa-eye"> Visitas <?= $resesp3['visitas'] ?></i></p>
                </div>
                <?php
            endforeach;
            ?>
        </div>
        <!--Da um espaçamento entro os blocos 3, 4.-->
        <div class="grid-g-12" style="margin-bottom:50px"></div>

        <h3 style="border-bottom: 4px solid #dd5a5a">
            <span style="background-color: #dd5a5a">POLITICA</span>
        </h3>

        <!--CATEGORIA 4.-->
        <div class="grid-g-6 grid-m-6 bloco1">
            <?php
            $idcat4 = funcoes::categoriaNome('politica');
            $read->ExeRead('posts', "WHERE status = 1 AND id_cat = :idc ORDER BY data_criacao DESC LIMIT :limit OFFSET :offset", "idc={$idcat4}&limit=1&offset=0");
            $resPol = $read->getResultado()[0];
            ?>
            <a href="<?= BASE . 'artigo/' . $resPol['url'] ?>"><img src="<?= BASE . 'uploads/' . $resPol['capa'] ?>" alt="<?= $resPol['titulo'] ?>" title="<?= $resPol['titulo'] ?>"></a>
            <div class="bloco1-conteudo">
                <h1><a href="<?= BASE . 'artigo/' . $resPol['url'] ?>"><?= funcoes::limtarTextos($resPol['titulo'], 50) ?></a></h1>
                <p>
                    <?= funcoes::limtarTextos($resPol['conteudo'], 90) ?>  
                </p>
                <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($resPol['data_criacao'])) ?></i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas <?= $resPol['visitas'] ?></i></p>
            </div>
        </div>
        <div class="grid-g-6 grid-m-6 bloco2" >
            <?php
            $read->setPlaces("idc={$idcat4}&limit=4&offset=1");
            foreach ($read->getResultado() as $respol3):
                ?>
                <div class="grid-g-3 grid-m-3">
                    <a href="<?= BASE . 'artigo/' . $respol3['url'] ?>"><img src="<?= BASE . 'uploads/' . $respol3['capa'] ?>" alt="<?= $respol3['titulo'] ?>" title="<?= $respol3['titulo'] ?>"></a>
                </div>
                <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                    <h1><a href="<?= BASE . 'artigo/' . $respol3['url'] ?>"><?= funcoes::limtarTextos($respol3['titulo'], 50) ?></a></h1>
                    <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($respol3['data_criacao'])) ?></i></time>
                    <p class="criado"><i class="fa fa-eye"> Visitas <?= $respol3['visitas'] ?></i></p>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </section>

    <!--ASIDE.-->
    <?php require 'inc/aside.php'; ?>
</main>
