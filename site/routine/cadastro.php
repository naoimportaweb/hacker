<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__DIR__) . "/api/mysql.php";
require      dirname(__DIR__) . '/vendors/PHPMailer/src/Exception.php';
require      dirname(__DIR__) . '/vendors/PHPMailer/src/PHPMailer.php';
require      dirname(__DIR__) . '/vendors/PHPMailer/src/SMTP.php';

function enviar_email($from, $to, $subject, $body){
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'contato@cursohacker.com.br';
    $mail->Password = 'Tubular11el!';
    $mail->setFrom($from, $from);
    $mail->addReplyTo($from, $from);
    $mail->addAddress($to, $to);
    $mail->Subject = $subject;
    $mail->Body = $body;
    return $mail->send();
}


function new_salt($parametros){
    $my = new Mysql("");
    return array("salt" => $my->Id("person"));
}

function load_person($parametros) {
    $my = new Mysql("");
    $email = strtolower($parametros["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die();
    }


    $buffer = $my->Datatable("SELECT per.*, cre.password FROM person as per inner join credential as cre on per.id = cre.id where per.email = ?", [ $email ]);
    if( count($buffer) > 0 ){
        if( $buffer[0]["password"] == $parametros["password"] ){
            $_SESSION["id"] = $buffer[0]["id"];
            return array("id" => $buffer[0]["id"], "name" => $buffer[0]["name"]);
        }
    }
    return array(); 
}




function impersonate($parametros) {
    $my = new Mysql("");
    $email = strtolower($parametros["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die();
    }

    $buffer = $my->Datatable("select * from person where id= ?", [ $_SESSION["id"] ]);
    if( count($buffer) > 0 and $buffer[0]["email"] == "wellington.aied@gmail.com"){
        $buffer = $my->Datatable("select * from person where email= ?", [ $email ]);
        $_SESSION["id"] = $buffer[0]["id"];
    }
    return array(); 
}


function find_salt_recuperar($parametros){
    $my = new Mysql("");

    $buffer = $my->Datatable("SELECT cre.salt FROM person as per inner join credential as cre on per.id = cre.id inner join recuperar as rec on per.email = rec.email where rec.id = ?", [ $parametros["id"] ]);
    if( count($buffer) > 0 ){
        return array( "salt" => $buffer[0]["salt"] );
    }
    return array(); 
}

function find_salt($parametros){
    $my = new Mysql("");
    $email = strtolower($parametros["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die();
    }


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
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die();
    }


    $buffer = $my->Datatable("SELECT * FROM person where email = ?", [ $email ]);
    if( count($buffer) == 0 ){
        $my->ExecuteNoQuery("INSERT INTO person     (id, email, name) values (?, ?, ?)",    [$id, $email, $email ]);
        $my->ExecuteNoQuery("INSERT INTO credential (id, salt, password) values (?, ?, ?)", [$id, $parametros["salt"], $parametros["password"] ]);
        
        $_SESSION["id"] = $id;
        return array( "id" => $id );
    }
    return array();
}




function enviar_recuperacao($parametros) {
    $my = new Mysql("");
    $email = strtolower($parametros["email"]);


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die();
    }


    $buffer = $my->Datatable("SELECT * FROM person where email = ?", [ $email ]);
    if( count($buffer) == 0 ){
        die();
    }

    $id = $my->Id("recuperar");
    $my->ExecuteNoQuery("INSERT INTO recuperar(id, email) values (?, ?)",    [$id, $email ]);

    //$subject = "Recuperar senha Curso Hacker";
    //$message = "Para recuperar sua senha, copie e cole a url em seu Browser: https://www.cursohacker.com.br/redefinir.php?id=" . $id;
    //$headers = "From: contato@cursohacker.com.br";
    //mail($email, $subject, $message, $headers);
    //if( enviar_email("contato@cursohacker.com.br", $email, "Recuperar senha Curso Hacker", "Para recuperar sua senha, copie e cole a url em seu Browser: https://www.cursohacker.com.br/redefinir.php?id=" . $id) ) {
    //    return array("id" => 1);
    //} else {
    //    die();
    //}
    enviar_email("contato@cursohacker.com.br", $email, "Recuperar senha Curso Hacker", "Para recuperar sua senha, copie e cole a url em seu Browser: https://www.cursohacker.com.br/redefinir.php?id=" . $id);
    return array("id" => 1);
    
}

//redefinir
function redefinir($parametros){
    $my = new Mysql("");
    //$email = strtolower($parametros["email"]);
    //if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //    die();
    //}

    $buffer = $my->Datatable("SELECT per.* FROM recuperar as rec inner join person as per on rec.email = per.email where rec.id = ? ", [ $parametros["id"]  ]);
    if( count($buffer) > 0 ){
        $buffer = $buffer[0];
        $my->ExecuteNoQuery("UPDATE `credential` set `password` = ? where id = ?",    [ $parametros["password"] , $buffer["id"] ]);
        $my->ExecuteNoQuery("DELETE from recuperar WHERE id= ?",    [ $parametros["id"] ]);
        return array( "msg" => "Sucesso.", "email" => $buffer["email"] );
    }
    return array();
}




include __DIR__ . "/exec.php";
?>
