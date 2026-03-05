<?php
require_once dirname(__DIR__) . "/api/mysql.php";

function add($parametros){
    $my = new Mysql("");
    $id = $my->Id("newsletter");
    $email = strtolower($parametros["email"]);
    $buffer = $my->Datatable("SELECT * FROM newsletter where email = ?", [ $email ]);
    if( count($buffer) == 0 )
        $my->ExecuteNoQuery("INSERT INTO newsletter (id, email, ip) values (?, ?, ?)", [$id, $email, IP()]);
    return array();
}

include __DIR__ . "/exec.php";
?>
