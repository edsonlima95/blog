<?php
ob_flush();
session_start();

use app\helper\Logar;
use app\helper\funcoes;

require '../vendor/autoload.php';
require '../app/config.php';
$login = new Logar();

//DESLOGA DO SISTEMA.
$sair = filter_input(INPUT_GET, 'logoff', FILTER_DEFAULT);

//VERIFICA SE A SESSAO TA CRIADA.
if (!$login->checkSession()):
    unset($_SESSION['user']);
    header('Location: login.php');
else:
    $user = $_SESSION['user'];
endif;

//VERIFICA SE O LOGOFF E TRUE, TEM QUE ESTA ABAIXO DO VERIFICA SESSAO.
if ($sair == true):
    unset($_SESSION['user']);
    header('Location: login.php?action=sair');
endif;


?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/estilo.css" rel="stylesheet" type="text/css"/>
        <link href="css/grids.css" rel="stylesheet" type="text/css"/>
        <link href="css/mobile.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <!--header.-->
        <?php require 'inc/header.php'; ?>

        <!--header.-->
        <?php require 'inc/menu.php'; ?>

        <main class="grid-g-10 grid-m-12 grid-p-12" style="float: right; position: relative; min-height: 100%">
            <?php
            $exe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
            funcoes::frontController($exe);
            ?>
            <?php require 'inc/footer.php'; ?>
        </main>
        <!--footer.-->
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jgrids.js" type="text/javascript"></script>
        <script src="js/jhome.js" type="text/javascript"></script>
        <!--fontawesome.-->
        <script src="https://use.fontawesome.com/c148575fe9.js"></script>
        <script src="js/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="js/tinny.js" type="text/javascript"></script>
        <script src="<?= BASE ?>/js/shadowbox/shadowbox.js" type="text/javascript"></script>
    </body>
</html>
<?php ob_end_flush(); ?>
