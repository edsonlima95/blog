<?php
use app\helper\funcoes;
use app\conn\read;
?>
<nav id="menu-mobile">
    <ul>
        <a href="#" class="close-menu">X</a>
        <li class="grid-g-12 logo-mobile">
            <div class="grid-m-12">
                <p>Cidade <strong>News</strong></a>
            </div> 
        </li>
        <li><a href="<?= BASE ?>categorias/politica">Politica</a>
            <ul class="sub-menu-mobile">
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
            <ul class="sub-menu-mobile">
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
            <ul class="sub-menu-mobile">
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
            <ul class="sub-menu-mobile">
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
            <ul class="sub-menu-mobile">
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
            <ul class="sub-menu-mobile">
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
        <li><a href="#">Contato</a></li>
    </ul>
</nav>