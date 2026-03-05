<?php
session_start();

require_once dirname(__DIR__) . "/api/mysql.php";

function new_salt($parametros){
    $my = new Mysql("");
    return array("salt" => $my->Id("person"));
}

function load_person($parametros) {
    $my = new Mysql("");
    $email = strtolower($parametros["email"]);
    $buffer = $my->Datatable("SELECT per.*, cre.password FROM person as per inner join credential as cre on per.id = cre.id where per.email = ?", [ $email ]);
    if( count($buffer) > 0 ){
        if( $buffer[0]["password"] == $parametros["password"] ){
            $_SESSION["id"] = $buffer[0]["id"];
            return array("id" => $buffer[0]["id"], "name" => $buffer[0]["name"]);
        }
    }
    return array(); 
}

function find_salt($parametros){
    $my = new Mysql("");
    $email = strtolower($parametros["email"]);
    $buffer = $my->Datatable("SELECT cre.salt FROM person as per inner join credential as cre on per.id = cre.id where per.email = ?", [ $email ]);
    if( count($buffer) > 0 ){
        return array( "salt" => $buffer[0]["salt"] );
    }
    return array(); 
}

function new_person($parametros){
    $my = new Mysql("");
    $id = $my->Id("person");
    $email = strtolower($parametros["email"]);
    $buffer = $my->Datatable("SELECT * FROM person where email = ?", [ $email ]);
    if( count($buffer) == 0 ){
        $my->ExecuteNoQuery("INSERT INTO person     (id, email, name) values (?, ?, ?)",    [$id, $email, $email ]);
        $my->ExecuteNoQuery("INSERT INTO credential (id, salt, password) values (?, ?, ?)", [$id, $parametros["salt"], $parametros["password"] ]);
        
        $_SESSION["id"] = $id;
        return array( "id" => $id );
    }
    return array();
}

include __DIR__ . "/exec.php";
?>
