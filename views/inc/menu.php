<?php

use app\conn\read;
?>
<nav id="menu-desk">
    <div class="botao-open">
        <span><i class="fa fa-bars fa-2x j_open"></i></span>
    </div>
    <div class="botao-pesquisa">
        <span><i class="fa fa-search fa-2x"></i></span>
    </div>
    <ul>
        <li><a href="<?= BASE ?>">Home</a></li>
        <li><a href="<?= BASE ?>categorias/politica">Politica</a>
            <ul class="sub-menu-site">
                <?php
                $id = app\helper\funcoes::categoriaNome('politica');
                $readSubMenu = new read();
                $readSubMenu->ExeRead('categorias', "WHERE id_pai = :idp LIMIT 5", "idp={$id}");
                if ($readSubMenu->getResultado()):
                    foreach ($readSubMenu->getResultado() as $resSubCat):
                        echo '<li><a href="'.BASE.'categorias/'.$resSubCat['url'].'">'.$resSubCat['nome'].'</a></li>';
                    endforeach;
                endif;
                ?>
            </ul>
        </li>
        <li><a href="<?= BASE ?>categorias/entretenimento">Entretenimento</a>
            <ul class="sub-menu-site">
                <?php
                $id = app\helper\funcoes::categoriaNome('entretenimento');
                $readSubMenu = new read();
                $readSubMenu->ExeRead('categorias', "WHERE id_pai = :idp LIMIT 5", "idp={$id}");
                if ($readSubMenu->getResultado()):
                    foreach ($readSubMenu->getResultado() as $resSubCat):
                        echo '<li><a href="'.BASE.'categorias/'.$resSubCat['url'].'">'.$resSubCat['nome'].'</a></li>';
                    endforeach;
                endif;
                ?>
            </ul>
        </li>
        <li><a href="<?= BASE ?>categorias/esportes">Esportes</a>
            <ul class="sub-menu-site">
                <?php
                $id = app\helper\funcoes::categoriaNome('esportes');
                $readSubMenu = new read();
                $readSubMenu->ExeRead('categorias', "WHERE id_pai = :idp LIMIT 5", "idp={$id}");
                if ($readSubMenu->getResultado()):
                    foreach ($readSubMenu->getResultado() as $resSubCat):
                        echo '<li><a href="'.BASE.'categorias/'.$resSubCat['url'].'">'.$resSubCat['nome'].'</a></li>';
                    endforeach;
                endif;
                ?>
            </ul>
        </li>
        <li><a href="<?= BASE ?>categorias/tecnologia">Tecnologia</a>
            <ul class="sub-menu-site">
                <?php
                $id = app\helper\funcoes::categoriaNome('tecnologia');
                $readSubMenu = new read();
                $readSubMenu->ExeRead('categorias', "WHERE id_pai = :idp LIMIT 5", "idp={$id}");
                if ($readSubMenu->getResultado()):
                    foreach ($readSubMenu->getResultado() as $resSubCat):
                        echo '<li><a href="'.BASE.'categorias/'.$resSubCat['url'].'">'.$resSubCat['nome'].'</a></li>';
                    endforeach;
                endif;
                ?>
            </ul>
        </li>
        <li><a href="<?= BASE ?>categorias/noticias">Mundo</a>
            <ul class="sub-menu-site">
                <?php
                $id = app\helper\funcoes::categoriaNome('noticias');
                $readSubMenu = new read();
                $readSubMenu->ExeRead('categorias', "WHERE id_pai = :idp LIMIT 5", "idp={$id}");
                if ($readSubMenu->getResultado()):
                    foreach ($readSubMenu->getResultado() as $resSubCat):
                        echo '<li><a href="'.BASE.'categorias/'.$resSubCat['url'].'">'.$resSubCat['nome'].'</a></li>';
                    endforeach;
                endif;
                ?>
            </ul>
        </li>
        <li><a href="<?= BASE ?>empresas/empresa-geral">Empresas</a>
            <ul class="sub-menu-site">
                <?php
                $readSubMenu = new read();
                $readSubMenu->ExeRead('categoria_empresas',"ORDER BY data_criacao DESC LIMIT 5");
                if ($readSubMenu->getResultado()):
                    foreach ($readSubMenu->getResultado() as $resSubCat):
                        echo '<li><a href="'.BASE.'empresas/'.$resSubCat['url'].'">'.$resSubCat['titulo'].'</a></li>';
                    endforeach;
                endif;
                ?>
            </ul>
        </li>
    </ul>
</nav>