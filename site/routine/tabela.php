<?php 
include dirname(__DIR__) . "/layout_const.php";


function preco($parametros){
    return array("anual" => $PRECO_ANO_BTC   , "taxa"  => $TAXA_ATUAL);
}

include __DIR__ . "/exec.php";


?>