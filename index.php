<?php
ob_flush();
session_start();
require './app/config.php';
require './vendor/autoload.php';

use app\helper\funcoes;
use app\helper\session;
use app\helper\link;

//GERENCIA A SESSAO DO SITE.
$session = new session();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        //OBTEM AS TAGS DO SITE.
        $link = new link();
        $link->getTags();
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--CSS.-->
        <link href="<?= INLCUDE ?>/css/estilos.css" rel="stylesheet" type="text/css"/>
        <link href="<?= INLCUDE ?>/css/grids.css" rel="stylesheet" type="text/css"/>
        <link href="<?= INLCUDE ?>/css/mobile.css" rel="stylesheet" type="text/css"/>
        <!-- CSS slide-->
        <link rel="stylesheet" type="text/css" href="<?= INLCUDE ?>/js/slide/engine1/style.css" />
        <!-- SHADOWBOX.-->
        <link href="<?= INLCUDE ?>/js/shadowbox/shadowbox.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="uploads/icon.ico"/>
    </head>
    <body>
        <div class="back-dark"></div>
        <div class="back-dark-2"></div>

        <?php
        //MENU MOBILE.
        require 'views/inc/menu-mobile.php';
        //CABEÇALHO
        require 'views/inc/header.php';
        //MENU-DESK
        require 'views/inc/menu.php';

        //RESPONSAVEL POR URL AMIGAVEL.
        funcoes::setHome();

        //FOOTER
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
        <!--API FACEBOOK.-->
        <div id="fb-root"></div>
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9&appId=1041001732695607";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
         </script>
    </body>
</html>
<?php
ob_end_flush();
?>