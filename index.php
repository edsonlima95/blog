<?php
ob_flush();
session_start();
require './app/config.php';
require './vendor/autoload.php';
use app\helper\funcoes;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <!--CSS.-->
        <link href="<?= INLCUDE ?>/css/estilos.css" rel="stylesheet" type="text/css"/>
        <link href="<?= INLCUDE ?>/css/grids.css" rel="stylesheet" type="text/css"/>
        <link href="<?= INLCUDE ?>/css/mobile.css" rel="stylesheet" type="text/css"/>
        <!-- CSS slide-->
        <link rel="stylesheet" type="text/css" href="<?= INLCUDE ?>/js/slide/engine1/style.css" />
        <!-- SHADOWBOX.-->
        <link href="<?= INLCUDE ?>/js/shadowbox/shadowbox.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <div class="back-dark"></div>
        <div class="back-dark-2"></div>
        
        <nav id="menu-mobile">
            <ul>
                <a href="#" class="close-menu">X</a>
                <li><a href="#">link</a></li>
                <li><a href="#">link</a></li>
                <li><a href="#">link</a></li>
            </ul>
        </nav>
        <?php
        //Cabealho
        require 'views/inc/header.php';
        //Menu
        require 'views/inc/menu.php';
       
        funcoes::setHome();
         
        require 'views/inc/footer.php';
        ?>
        <!--BOTÃO VOLTA TOP.-->
        <div id="topo"><i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></div
        
        <!--Scripts.-->
        <script src="<?= INLCUDE ?>/js/jquery.js" type="text/javascript"></script>
        <script src="<?= INLCUDE ?>/js/j_home.js" type="text/javascript"></script>
        <!--Slide.-->
        <script type="text/javascript" src="<?= INLCUDE ?>/js/slide/engine1/wowslider.js"></script>
        <script type="text/javascript" src="<?= INLCUDE ?>/js/slide/engine1/script.js"></script>
        <!--fontawesome.-->
        <script src="https://use.fontawesome.com/c148575fe9.js"></script>
        <!--SHADOWBOX.-->
        <script src="<?= INLCUDE ?>/js/shadowbox/shadowbox.js" type="text/javascript"></script>
    </body>
</html>
<?php
ob_end_flush();
?>