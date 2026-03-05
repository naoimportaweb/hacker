<?php

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once dirname(__DIR__) . '/api/mysql.php';
require_once dirname(__DIR__) . '/api/json.php';
require_once dirname(__DIR__) . '/api/aes.php';
$config = Json::FromFile_v2(dirname(__DIR__) . "/data/config.json");



$mysql = new Mysql("");

//$data = json_decode( decrypt( file_get_contents('php://input'), $config["aes"] ), true);
$data = json_decode( file_get_contents('php://input'), true); 

//if($data["token"] != "bf080fb4-c2bb-4266-9c58-2f5855a60e3a"){
//    die();
//}

if( $data["action"] == "executenoquery" ) {
    echo json_encode( $mysql->ExecuteNoQuery( $data["sqls"], $data["valuess"] ) );
} elseif( $data["action"] == "datatable" ) {
    echo json_encode( $mysql->DataTable( $data["sql"], $data["values"] ) );
} elseif( $data["action"] == "id" ) {
    echo json_encode( $mysql->Id( $data["table"] ) );
}

?>