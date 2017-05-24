<?php require 'inc/slide.php'; 
use app\helper\funcoes;
?>
<main class="grid-g-12">
    <section class="grid-g-8 conteudo-esquerdo">  
        <h3>
            <span>CATEGORIAS 1</span>
        </h3>
        <!--CATEGORIAS 1.-->
        <div class="grid-g-6 grid-m-6 bloco1">
            <a href="artigo/nome-do-artigo"><img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title=""></a>
            <div class="bloco1-conteudo">
                <h1><a href="artigo/nome-do-artigo"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></a></h1>
                <p>
                   <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor amet consectetur adipisicing eiusmod tempor eiusmod tempor amet consectetur adipisicing eiusmod tempor', 90) ?>    
                </p>
                <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas 3000</i></p>
            </div>
        </div>
        <div class="grid-g-6 grid-m-6 bloco2" >
            <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="grid-g-3 grid-m-3">
                    <a href="artigo/nome-do-artigo"><img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title=""></a>
                </div>
                <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                    <h1><a href="artigo/nome-do-artigo"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></a></h1>
                    <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                    <p class="criado"><i class="fa fa-eye"> Visitas 3000</i></p>
                </div>
            <?php endfor; ?>
        </div>
        

        <!--CATEGORIAS 2 .--> 
        <div class="grid-g-6 grid-m-6 bloco1 cat2">
            <h3 class="titulo-cat2">
                <span>CATEGORIAS 2</span>
            </h3>
            <a href="artigo/nome-do-artigo"><img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title="" ></a>
            <div class="bloco1-conteudo">
                <h1><a href="artigo/nome-do-artigo"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></a></h1>
                <p>
                   <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor amet consectetur adipisicing eiusmod tempor eiusmod tempor amet consectetur adipisicing eiusmod tempor', 90) ?>   
                </p>
                <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                 <p class="criado"><i class="fa fa-eye"> Visitas 3000</i></p>
            </div>
        </div>
        
        
        <!--CATEGORIA 3.-->
        <div class="grid-g-6 grid-m-6 bloco1 cat3">
            <h3 class="titulo-cat3">
                <span>CATEGORIAS 3</span>
            </h3>
            <a href="artigo/nome-do-artigo"><img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title=""></a>
            <div class="bloco1-conteudo">
                <h1><a href="#"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></a></h1>
                <p>
                   <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor amet consectetur adipisicing eiusmod tempor eiusmod tempor amet consectetur adipisicing eiusmod tempor', 90) ?>   
                </p>
                <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas 3000</i></p>
            </div>
        </div>
        
        <!--3 aritgos categoria 2.-->
        <div class="grid-g-6 grid-m-6 bloco2 art3">
            <?php for ($i = 0; $i < 3; $i++): ?>
                <div class="grid-g-3 grid-m-3">
                    <a href="artigo/nome-do-artigo"><img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title=""></a>
                </div>
            <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                    <h1><a href="artigo/nome-do-artigo"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></a></h1>
                    <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                   <p class="criado"><i class="fa fa-eye"> Visitas 3000</i></p>
                </div>
            <?php endfor; ?>
        </div>
        
        <!--3 aritgos categoria 3.-->
        <div class="grid-g-6 grid-m-6 bloco2 art4">
            <?php for ($i = 0; $i < 3; $i++): ?>
                <div class="grid-g-3 grid-m-3">
                    <a href="artigo/nome-do-artigo"><img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title=""></a>
                </div>
                <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                    <h1><a href="artigo/nome-do-artigo"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></a></h1>
                    <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                    <p class="criado"><i class="fa fa-eye"> Visitas 3000</i></p>
                </div>
            <?php endfor; ?>
        </div>
        
        <!--Da um espaçamento entro os blocos 3, 4.-->
        <div class="grid-g-12" style="margin-bottom:50px"></div>
        
        <h3 style="border-bottom: 4px solid #dd5a5a">
            <span style="background-color: #dd5a5a">CATEGORIAS 4</span>
        </h3>
        
        <!--CATEGORIA 4.-->
        <div class="grid-g-6 grid-m-6 bloco1">
            
            <a href="artigo/nome-do-artigo"><img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title=""></a>
            <div class="bloco1-conteudo">
                <h1><a href="artigo/nome-do-artigo"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></a></h1>
                <p>
                    <?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor amet consectetur adipisicing eiusmod tempor eiusmod tempor amet consectetur adipisicing eiusmod tempor', 90) ?>    
                </p>
                <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                <p class="criado"><i class="fa fa-eye"> Visitas 3000</i></p>
            </div>
        </div>
        <div class="grid-g-6 grid-m-6 bloco2" >
            <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="grid-g-3 grid-m-3">
                    <a href="artigo/nome-do-artigo"><img src="<?= INLCUDE ?>/img/img3.jpg" alt="" title=""></a>
                </div>
                <div class="grid-g-9 grid-m-9 bloco2-conteudo">
                    <h1><a href="artigo/nome-do-artigo"><?= funcoes::limtarTextos('Lorem ipsum dolor sit amet consectetur adipisicing eiusmod tempor', 50) ?></a></h1>
                    <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                  <p class="criado"><i class="fa fa-eye"> Visitas 3000</i></p>
                </div>
            <?php endfor; ?>
        </div>
    </section>
    
    <!--ASIDE.-->
    <?php require 'inc/aside.php';?>
</main>
