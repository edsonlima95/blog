<?php

use app\helper\galeria;

require './vendor/autoload.php';

$galeria = new galeria();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(isset($dados['enviar'])):
    unset($dados['enviar']);
    $dados = $_FILES['imgs'];
   $galeria->enviaGaleria($dados,1);

endif;

?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="imgs[]" multiple="">
    <input type="submit" name="enviar" value="ok">
</form>