<?php
use app\helper\funcoes;
?>
<main class="grid-g-12">
    <section class="grid-g-12 conteudo-esquerdo categorias">
        <span>Nome da categoria</span>
        <?php for ($i=0; $i < 12; $i++):?>
        <article class="grid-g-3 grid-m-6 grid-p-12 bloco1">
            <a href="artigo/nome-do-artigo"><img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title=""></a>
            <div class="bloco1-conteudo">
                <h1><a href="artigo/nome-do-artigo"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 30) ?></a></h1>
                <p>
                   <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor amet consectetur adipisicing eiusmod tempor eiusmod tempor amet consectetur adipisicing eiusmod tempor', 65) ?>    
                </p>
                <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                <p class="criado"><i class="fa fa-user"> Edson lima</i></p>
            </div>
        </article>
        <?php endfor;?>
        <div class="paginator">
            <a href="#">1</a>
            <a href="#">2</a>
            <a class="atv">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
        </div>
    </section>
</main>

