<header class="cabecalho grid-g-12">
    <div class="botao-open">
        <span><i class="fa fa-bars fa-2x j_open"></i></span>
    </div>
    <p style="float: left"><a href="index.php">Dashboard</a></p>
    <nav class="menu-perfil">
        <ul>
            <li><i class="fa fa-user"></i><a style="cursor: pointer">Perfil</a>
                <ul class="sub-perfil">
                    <li><a href="index.php?exe=usuarios/update&iduser=<?= $_SESSION['user']['id'] ?>"><i class="fa fa-edit"></i> Perfil</a></li>
                    <li><a href="index.php?logoff=true"><i class="fa fa-sign-out"></i> Sair</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>