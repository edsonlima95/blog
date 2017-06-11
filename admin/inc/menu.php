<nav class="menu-lateral grid-g-2 grid-m-4 grid-p-6">  
    <ul>
        <li class="img-perfil">
            <?php

            use app\conn\read;
            
            $readUserImg = new read();
            $readUserImg->ExeRead('usuarios', "WHERE id = :id", "id={$user['id']}");
            $userimg = $readUserImg->getResultado()[0]['capa'];
            ?>
            <img src="<?php
            if ($userimg)
                echo '../uploads/' . $userimg;
            else
                echo 'img/perfil.png';
            ?>" width="100" height="100">
        </li>
        <li><a>Categorias <i class="fa fa-chevron-right"></i></a>
            <ul class="sub-lateral">
                <li><a href="index.php?exe=categorias/criar">Criar nova</a></li>
                <li><a href="index.php?exe=categorias/index">Editar e excluir</a></li>
            </ul>
        </li>
        <li><a>Posts <i class="fa fa-chevron-right"></i></a>
            <ul class="sub-lateral">
                <li><a href="index.php?exe=posts/criar">Criar novo</a></li>
                <li><a href="index.php?exe=posts/index">Editar e excluir</a></li>
            </ul>
        </li>
        <li><a>Empresa categoria <i class="fa fa-chevron-right"></i></a>
            <ul class="sub-lateral">
                <li><a href="index.php?exe=empresas_cat/criar">Criar nova</a></li>
                <li><a href="index.php?exe=empresas_cat/index">Editar e excluir</a></li>
            </ul>
        </li>
        <li><a>Empresa <i class="fa fa-chevron-right"></i></a>
            <ul class="sub-lateral">
                <li><a href="index.php?exe=empresas/criar">Criar nova</a></li>
                <li><a href="index.php?exe=empresas/index">Editar e excluir</a></li>
            </ul>
        </li>
        <li><a>Publicidade <i class="fa fa-chevron-right"></i></a>
            <ul class="sub-lateral">
                <li><a href="index.php?exe=publicidade/publicidade">Criar nova</a></li>
            </ul>
        </li>
        <?php
        if ($user['id'] == 1):
            ?>
            <li><a>Usuários <i class="fa fa-chevron-right"></i></a>
                <ul class="sub-lateral">
                    <li><a href="index.php?exe=usuarios/criar">Criar novo</a></li>
                    <li><a href="index.php?exe=usuarios/index">Editar e excluir</a></li>
                </ul>
            </li>
            <?php
            else:
        endif;
        ?>
    </ul>
</nav>