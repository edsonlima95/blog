<?php
use app\helper\funcoes;
?>
<aside class="grid-g-4 grid-m-12  conteudo-direito">

    <section class="grid-g-12 grid-m-6">
        <h3>
            <span>Top 5 posts mais vistos.</span>
        </h3>
        <?php for ($i = 0; $i < 5; $i++): ?>
            <div class="grid-g-3 grid-m-3">
                <img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title="">
            </div>
            <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                <h1><a href="#"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></a></h1>
                <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas 3000</i></p>
            </div>
        <?php endfor; ?>
    </section>

    <section class="top-empresas grid-g-12 grid-m-6">
        <h3>
            <span>Top 5 empresas mais vistas</span>
        </h3>
        <?php for ($i = 0; $i < 5; $i++): ?>
            <ul class="j_empresa">
                <li>Desc: <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></li>
                <li>Rua: <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></li>
                <li>Bairro: <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></li>
                <li>Cidade: <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></li>
                <li>Estado: <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></li>
                <li>Contato: <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></li>
            </ul>
            <div class="grid-g-3 grid-m-3">
                <a href="empresa/nome-da-empresa"><img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title=""></a>
            </div>
            <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                <h1><a href="empresa/nome-da-empresa"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></a></h1>
                <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas 3000</i></p>
            </div>
        <?php endfor; ?>
    </section>
    <h3>
        <span>Nossos parceiros</span>
    </h3>
</aside>