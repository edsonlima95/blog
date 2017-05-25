<?php
use app\helper\Logar;
ob_flush();
session_start();

require '../vendor/autoload.php';
$login = new Logar();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/login.css" rel="stylesheet" type="text/css"/>
        <link href="css/grids.css" rel="stylesheet" type="text/css"/>
        <title>Login do sistema</title>
    </head>
    <body>
        <section class="login grid-g-3 grid-m-3 grid-p-3">
            <i class="fa fa-lock fa-3x"></i>
            <?php
            //Verifica se a sessao esta criada, se sim retorna pro painel.
            if ($login->checkSession()):
                header('Location: index.php');
            endif;

            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);

            //Verifica o tipo de alerta.
            if ($action == 'sair'):
                echo '<div class="success">Você deslogou do sistema com sucesso parabens!<span class="x">x</span></div>';
            endif;

            if (isset($dados) && $dados['enviar']):
                unset($dados['enviar']);
                $login->login($dados['email'], $dados['senha']);
                //Verifica se o email e senha retorna true e redireciona.
                if ($login->getResultado()):
                    header('Location: index.php');
                else:
                    echo '<div class="info">'.$login->getErro().'<span class="x">x</span></div>';
                endif;
            endif;
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="email"><i class="fa fa-envelope"> Email:</i>
                    <input type="email" name="email" required id="email" placeholder="Email">
                </label>

                <label for="senha"><i class="fa fa-unlock-alt"> Senha:</i>
                    <input type="password" name="senha" required id="senha" placeholder="Senha">
                </label>
                <input type="submit" name="enviar" value="Logar">
            </form>
        </section>
        <!--jquery.-->
        <script src="js/jquery.js" type="text/javascript"></script>
        <!--jgrids.-->
        <script src="js/jgrids.js" type="text/javascript"></script>
        <!--fontawesome.-->
        <script src="https://use.fontawesome.com/c148575fe9.js"></script>
    </body>
</html>
<?php ob_end_flush(); ?>