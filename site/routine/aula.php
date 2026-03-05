<?php

require_once dirname(__DIR__) . "/api/mysql.php";

function historico($parametros){
    $my = new Mysql("");
    $buffer = $my->Datatable("SELECT au.titulo as titulo, au.data as data, cu.nome as curso FROM aula as au inner join curso as cu where au.curso_id = cu.id order by au.data desc limit 50", [  ]);
    return $buffer;
}

include __DIR__ . "/exec.php";
?>
