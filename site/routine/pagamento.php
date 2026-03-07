<?php
session_start();

require_once dirname(__DIR__) . "/api/mysql.php";


function pagar($parametros){
    $my = new Mysql("");
    $buffer = $my->Datatable("SELECT * FROM pagamento where  hash = ? and data_inicio is null", [ $parametros["hash"] ]);
    if(count($buffer) > 0) {
        return $my->ExecuteNoQuery("UPDATE pagamento set data_inicio = now(), data_fim= DATE_ADD(now(), INTERVAL 1 YEAR), metodo = 2, valor = ? where id = ?", [$parametros["value"],  $buffer[0]["id"] ]);
    }
    return array("total" => 0 );
}


function enviar($parametros){
    $my = new Mysql("");
    $hash = trim($parametros["tx_id"]);
    $buffer = $my->Datatable("SELECT * FROM pagamento where hash = ? ", [ $hash ]);
    if( count($buffer) > 0 ) {
        return array("status" => false, "message" => "Essa TX ID já foi cadastrada.");
    }

    #b7d6682f-519b-4f1d-995a-78afcd4d7188
    $id = $my->Id("pagamento");
    $buffer = $my->Datatable("SELECT * FROM doacao where txid = ? ", [ $hash ]);
    if( count($buffer) > 0 ) {
        $my->ExecuteNoQuery("INSERT INTO pagamento (id, person_id, hash, metodo, data_inicio, data_fim) values (?, ?, ?, 1, now(), DATE_ADD(now(), INTERVAL 1 YEAR))", [$id, $_SESSION["id"], $hash]);
    } else {
        $my->ExecuteNoQuery("INSERT INTO pagamento (id, person_id, hash) values (?, ?, ?)", [$id, $_SESSION["id"], $hash]);
    }

    return array("status" => true, "message" => "Agora é só aguardar.");
}


function listar($parametros){
    $my = new Mysql("");
    $buffer = $my->Datatable("SELECT * FROM pagamento where person_id = ? order by data desc limit 6", [ $_SESSION["id"] ]);
    return $buffer;
}

include __DIR__ . "/exec.php";
?>
