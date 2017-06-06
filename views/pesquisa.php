<?php

use app\helper\funcoes;
use app\conn\read;
use app\helper\link;
use app\helper\paginacao;

//OBTEM AS TAGS DO ARTIGO.
$link = new link();
$link->getTags();

//Conta os resultados de acordo com o nome da pessquisa
$result = (isset($link->getDados()['count']) ? $link->getDados()['count'] : '0');

//Recebe o nome passado na url no indice 1.
$nome = $link->getLocal()[1];
?>
<main class="grid-g-12">
    <section class="grid-g-12 conteudo-esquerdo categorias">
        <?php
            echo '<span>Sua pesquisa por: '.$nome.' retornou '.$result.' resultados</span>';
            
            //PAGINACAO.
            $atual = (isset($link->getLocal()[2]) ? $link->getLocal()[2] : '1');
            $paginacao = new paginacao(BASE . 'pesquisa/' . $nome . '/');
            $paginacao->pagina($atual, 12);

            $readP = new read();
            $readP->ExeRead('posts', "WHERE status = 1 AND (titulo LIKE '%' :titulo '%' OR conteudo LIKE '%' :con '%') ORDER BY data_criacao DESC LIMIT :limit OFFSET :offset", "titulo={$nome}&con={$nome}&limit={$paginacao->getLimit()}&offset={$paginacao->getOffset()}");
            if ($readP->getResultado()):
                foreach ($readP->getResultado() as $resP):
                    ?>
                    <article class="grid-g-3 grid-m-6 grid-p-12 bloco1">
                        <a href="<?= BASE . 'artigo/' . $resP['url'] ?>"><img src="<?= BASE . 'uploads/' . $resP['capa'] ?>" alt="<?= $resP['titulo'] ?>" title="<?= $resP['titulo'] ?>"></a>
                        <div class="bloco1-conteudo">
                            <h1><a href="<?= BASE . 'artigo/' . $resP['url'] ?>"><?= funcoes::limtarTextos($resP['titulo'], 30) ?></a></h1>
                            <p>
                                <?= funcoes::limtarTextos($resP['conteudo'], 65) ?>    
                            </p>
                            <time><i class="fa fa-calendar"> <?= date('d-m-Y', strtotime($resP['data_criacao'])) ?></i></time>
                            <p class="criado"><i class="fa fa-user"> <?= $resP['autor'] ?></i></p>
                        </div>
                    </article>
                    <?php
                endforeach;
            endif;
            ?>
            <div class="paginator">
                <?php
                $paginacao->paginacao('posts', "WHERE status = 1 AND (titulo LIKE '%' :titulo '%' OR conteudo LIKE '%' :con '%') ORDER BY data_criacao DESC", "titulo={$nome}&con={$nome}");
                echo $paginacao->paginator();
            ?>
        </div>
    </section>
</main>

