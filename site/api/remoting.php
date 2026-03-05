<?php

require_once __DIR__ . '/json.php';
require_once __DIR__ . '/aes.php';
require_once __DIR__ . '/mysql.php';

class Remoting
{    
    function __construct($config) {
        $this->CONFIG_NAME = $config;
        $buffer_json = Json::FromFile_v2(dirname(__DIR__) . "/data/config.json");
        if ($buffer_json["remoting"][ $config ]["name"] !=  $buffer_json["name"]) {
            $this->CONFIG = $buffer_json["remoting"][ $config ];
        } else {
            $this->CONFIG = $buffer_json["connections"][ $config ];
        }
    }
    public static function genId(){
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                        mt_rand( 0, 0xffff ), 
                        mt_rand( 0, 0xffff ),
                        mt_rand( 0, 0xffff ),
                        mt_rand( 0, 0x0fff ) | 0x4000,
                        mt_rand( 0, 0x3fff ) | 0x8000,
                        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
                        );
    }
    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), 
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }


    public function enviar_generico($requestContent){
        //$url = $this->CONFIG["host"] . "/services/connect.php";
        $url = "https://youtubermentality.com/site" . "/services/connect.php";
        $retorno = file_get_contents( $url ,
            false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded",
                    'content' => json_encode( $requestContent )
                ]
            ])) ;
        return json_decode( $retorno, true );
    }

    public function Datatable($sql, $values){
        if( $this->CONFIG["type"] == "remoting" ) {
            $requestContent = array("action" => "datatable", "sql" => $sql, "values" => $values);
            return $this->enviar_generico($requestContent);
        } else {
            $mysql = new Mysql( $this->CONFIG_NAME );
            return $mysql->Datatable($sql, $values);
        }
    }
    
    public function ExecuteNoQuery($sqls, $valuess){
        if( $this->CONFIG["type"] == "remoting" ) {
            $requestContent = array("action" => "executenoquery", "sqls" => $sqls, "valuess" => $valuess);
            return $this->enviar_generico($requestContent);
        } else {
            $mysql = new Mysql( $this->CONFIG_NAME );
            return $mysql->ExecuteNoQuery($sqls, $valuess);
        }
    }

    public function StoreJs( $path, $data ){
        $requestContent = array("action" => "storejs", "path" => $path, "data" => $data);
        return $this->enviar_generico($requestContent);
    }

    public function LoadJs( $path ){
        $requestContent = array("action" => "loadjs", "path" => $path);
        return $this->enviar_generico($requestContent);
    }

    public function ExistsJs( $path ){
        $requestContent = array("action" => "existsjs", "path" => $path);
        return $this->enviar_generico($requestContent);
    }

    public function RemoveJs( $path ){
        $requestContent = array("action" => "removejs", "path" => $path);
        return $this->enviar_generico($requestContent);
    }
}

?>