<section id="slide-noticia" class="grid-g-12">
    <div class="grid-g-6 slide">
        <div id="wowslider-container1">
            <div class="ws_images">
                <ul>
                    <?php for ($i = 0; $i < 3; $i++): ?>
                        <li>
                            <a href="<?= BASE?>artigo/nome-do-artigo"><img src="<?=INLCUDE ?>/img/img3.jpg" alt="" title="" id="wows1_0"/></a>
                            <a href="<?= BASE?>artigo/nome-do-artigo"><h1>Imagem 1</h1></a>
                            <a href="#"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a></p></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
    <section class="grid-g-6 box-noticias-slide">
        <?php
        for ($i = 0; $i < 4; $i++):
            ?>
            <article class="grid-g-6 grid-m-4 grid-p-12 noticias-do-slide"> 
                <a href="artigo/nome-do-artigo"><img src="<?=INLCUDE ?>/img/img3.jpg" alt="" title=""></a>
                <div class="conteudo-noticias">
                    <h1><a href="artigo/nome-do-artigo">Noticias sobre o mundo...</a></h1>
                    <time><i class="fa fa-calendar"> 02-04-2017</i></time>
                    <p class="criado" style="font-size: 10px"><i class="fa fa-eye"> Visitas 3000</i></p>
                </div>
            </article>
            <?php
        endfor;
        ?>
    </section>
</section>