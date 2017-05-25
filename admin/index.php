<?php
ob_flush();
//session_start();

use app\helper\Logar;
use app\helper\funcoes;

require '../vendor/autoload.php';
$login = new Logar();
if (!$login->checkSession()):
    header('Location: login.php');
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
        <?php require 'inc/header.php';?>
        
        <!--header.-->
        <?php require 'inc/menu.php';?>
        
        <main class="grid-g-10 grid-m-12 grid-p-12" style="float: right">
            <?php
            $exe = filter_input(INPUT_GET,'exe',FILTER_DEFAULT);
            funcoes::frontController($exe);
            ?>
        </main>
       <!--footer.-->
        <?php require 'inc/footer.php';?>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jgrids.js" type="text/javascript"></script>
        <script src="js/jhome.js" type="text/javascript"></script>
        <!--fontawesome.-->
        <script src="https://use.fontawesome.com/c148575fe9.js"></script>
        <!--Goggle grafico.-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="js/ggrafico.js" type="text/javascript"></script>
        <script src="js/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script src="js/tinny.js" type="text/javascript"></script>
    </body>
</html>
<?php ob_end_flush(); ?>
