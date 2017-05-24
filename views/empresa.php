<?php
use app\helper\funcoes;
?>
<main class="grid-g-12">
    <section class="grid-g-8 conteudo-esquerdo artigo">  
            <h1>Nome da empresa</h1>
             <!--Artigo.-->
            <img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title="">
            <div class="artigo-conteudo">
                <h2><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor consectetur adipisicing eiusmod tempor', 100) ?></h2>
                <ul class="descricao-empresa">
                    <li>Endereço: <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p></li>
                    <li>Bairro: <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p></li>
                    <li>Cidade: <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p></li>
                    <li>Estado: <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut</p></li>
                </ul>
                <p class="conteudo">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.
                </p>
                <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                <p class="criador"><i class="fa fa-user"> Edson lima</i></p>
            </div>
            <!--Galeria.-->
            <h3 class="titulo-galeria">
                <span>Galeria de Imagens</span>
            </h3>
            <?php for($i=0; $i < 8; $i++):?>
            <div class="grid-g-3 galeria">
                <a href="<?= INLCUDE ?>/img/img3.jpg" rel="shadowbox[idpost]">
                    <img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title="" height="170px">
                </a>
            </div>
            <?php endfor;?>
    </section>
    
    <!--ASIDE.-->
    <?php require 'inc/aside.php';?>
    
</main>
