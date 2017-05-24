<?php
sleep(1);
use app\conn\read;
require '../../vendor/autoload.php';

$idest = filter_var($_POST['idestado'],FILTER_SANITIZE_NUMBER_INT);

$readCidades = new read();

$readCidades->ExeRead('cidades',"WHERE estado_id = :id ORDER BY cidade_nome ASC","id={$idest}");

foreach ($readCidades->getResultado() as $resCid):
    echo '<option value="'.$resCid['cidade_id'].'">'.$resCid['cidade_nome'].'</option>';
endforeach;

?>


