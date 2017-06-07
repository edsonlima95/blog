<header id="cabecalho" class="grid-g-12">
    <section class="midias-sociais">
        <?php
        $m = array("01" => "Janeiro", "02" => "Fevereiro", "03" => "Março", "04" => "Abril", "05" => "Maio", "06" => "Junho", "07" => "Julho", "08" => "Agosto", "09" => "Setembro", "10 " => "Outubro", "11" => "Novembro", "12" => "Dezembro");
        $d = date('d');
        $mes = date('m');
        $ano = date('Y');
        ?>
        <ul class="grid-m-6">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
        </ul>

        <span><?= "Hoje: {$d} de {$m[$mes]} de {$ano}" ?></span>

    </section>
    <section class="grid-g-12 logo">
        <div class="grid-g-6 grid-m-6">
            <a href="<?=BASE?>"><p>Cidade <strong>News</strong></a>
        </div>
        <div class="pesquisa">
            <?php
            $search = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ($search['busca']):
                header('Location: ' . BASE . 'pesquisa/' . $search['busca']);
            endif;
            ?>
            <form name="busca-geral" method="post" class="busca-geral">
                <input type="search" name="busca" placeholder="Busca">
                <span><i class="fa fa-search j_send"></i></span>
            </form>
        </div>
    </section>
    <div style="clear: both"></div>
</header>