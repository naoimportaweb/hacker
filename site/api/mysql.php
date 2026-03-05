<?php

//use PDO;
//DROP USER root@localhost;
//CREATE USER root@localhost IDENTIFIED BY '123456';
//GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost';
//FLUSH PRIVILEGES;

require_once __DIR__ . '/json.php';

class Mysql
{
    var $server = null;
    var $CONFIG = null;
    
    function __construct($config) {
        $buffer_json = Json::FromFile_v2(dirname(__DIR__) . "/data/config.json");
        if( $config == "" ) {
            $config = $buffer_json["default"];
        }
        $this->CONFIG = $buffer_json["connections"][ $config ];
        if( $this->CONFIG["type"] == "mysql" ) {
            $this->server = new MysqlLocal( $buffer_json["default"] );
        } else {
            $this->server = new MysqlRemoto( $buffer_json["default"] );
        }
    }

    public function Id($table) {
        return $this->server->Id($table);
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
    
    public function __destruct() { 
        $this->server = null;
    }

    public function  Connection(){
        return $this->server->Connection();
    }
    // preparement state pdo: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
    public function Datatable($sql, $values){
        return $this->server->Datatable($sql, $values);
    }
    
    public function Procedure($procedure, $values, $tables){
        $this->server->Procedure($procedure, $values, $tables);
    }

    public function ExecuteNoQuery($sqls, $valuess){
        return $this->server->ExecuteNoQuery($sqls, $valuess);
    }


}
// ---------------------------------------
class MysqlLocal
{
    var $con = null;
    var $action = false;
    
    function __construct($config) {
        $buffer_json = Json::FromFile_v2(dirname(__DIR__) . "/data/config.json");
        if( $config == "" ) {
            $config = $buffer_json["connections"]["default"];
        } else {
            $config = $buffer_json["connections"][ $config ];
        }
        $this->CONFIG = $config;
    }

    public function Id($table) {
        $n = 65;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for($t = 0; $t < 10; $t++) {
            for ($i = 0; $i < $n; $i++) {
                $index = random_int(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }

            $buffer = $this->Datatable("SELECT id FROM ". $table ." WHERE id = ?", [$randomString]);
            if(count($buffer) == 0) {
                break;
            }
        }
        return $randomString;
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
    
    public function __destruct() { 
        $this->con = null;
    }

    public function  Connection(){
        try
        {
            if($this->con == null){
                $port = 3306;
                $this->con = new PDO('mysql:host=' . $this->CONFIG["host"] . ';port='. $port .';charset=utf8;dbname=' . $this->CONFIG["name"], $this->CONFIG["user"], $this->CONFIG["password"]);
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $this->con;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    // preparement state pdo: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
    public function Datatable($sql, $values){
        try{
            //$this->Connection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $this->Connection()->prepare($sql);
            $query->execute($values);
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }catch(Exception $e){
            throw new Exception('Erro: ' .  $e->getMessage() . " - " . $sql);
        } finally {
            //if($this->action == false) {
                $this->con = null;
            //}
        }
    }
    
    public function Procedure($procedure, $values, $tables){
        //$stmt = $this->Connection()->query("call " . $procedure . "();");
        $sql = "CALL " . $procedure . " (";
        for($i = 0; $i < count($values); $i++){
            $sql = $sql . " ? ";
            if($i < count($values) - 1){
                $sql = $sql . " , ";
            }                     
        }
        $sql = $sql . ")";
        $stmt = $this->Connection()->prepare($sql);
        for($i = 0; $i < count($values); $i++){
            $stmt->bindParam($i + 1, $values[$i]); 
        }
        $stmt->execute();
        
        $retorno = Array();
        $i = 0;
        //do {
        $tabela = Array();
        //https://www.php.net/manual/pt_BR/pdostatement.fetch.php
        //$rowset = $stmt->fetchAll(PDO::FETCH_NUM);
        $rowset = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($rowset) {
            foreach ($rowset as $row) {
                array_push($tabela, $row);
            }
        }


        return [$tabela];
    }

    public function ExecuteNoQuery($sqls, $valuess){
        try{
            $row_count = 0;
            if( ! is_array($sqls)){
                $sqls = [$sqls];
                $valuess = [$valuess];
            }
            //$this->Connection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if( count( $sqls ) > 1 ){
                $this->Connection()->beginTransaction();
            }

            for($i  = 0; $i < count($valuess); $i++) {
                for($j = 0; $j < count($valuess[$i]); $j++) {
                    if( is_string( $valuess[$i][$j] ) == true ) {
                        $valuess[$i][$j] = htmlspecialchars( $valuess[$i][$j], ENT_QUOTES, 'UTF-8');
                    }
                }
            }

            for($i = 0; $i < count($sqls); $i++) {
                $sql = $sqls[$i];
                $values = $valuess[$i];
                $query = $this->Connection()->prepare($sql);
                $query->execute($values);
                $row_count = $row_count + $query->rowCount();
            }

            if( count( $sqls ) > 1 ){
                $this->Connection()->commit();
            }
            
            return $row_count; 
            
        }catch(Exception $e){
            $this->Connection()->rollback();
            throw $e;
        } finally {
            if($this->action == false) {
                $this->con = null;
            }
        }
        return 0;
    }





    public function BeginTransaction(){
        $this->Connection()->beginTransaction();
        $this->action = true;
    }

    public function CommitTransaction(){
        $this->Connection()->commit();
        $this->action = false;
    }

    public function RollbackTransaction(){
        $this->Connection()->rollback();
        $this->action = false;
    }

}

// ---------------------------------------------------------------------


class MysqlRemoto
{
    var $token = "bf080fb4-c2bb-4266-9c58-2f5855a60e3a";
    function __construct($config) {
        $buffer_json = Json::FromFile_v2(dirname(__DIR__) . "/data/config.json");
        if( $config == "" ) {
            $config = $buffer_json["connections"]["default"];
        } else {
            $config = $buffer_json["connections"][ $config ];
        }
        $this->CONFIG = $config;
    }

    public function Id($table) {
        $requestContent = array("action" => "id", "table" => $table, "token" => self.token);
        return $this->enviar_generico($requestContent);
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

    public function Datatable($sql, $values){
        $requestContent = array("action" => "datatable", "sql" => $sql, "values" => $values, "token" => $this->token);
        $buffer = $this->enviar_generico($requestContent);
        #error_log(json_encode($buffer), 0);
        return $buffer;
    }
    
    public function ExecuteNoQuery($sqls, $valuess){
        $requestContent = array("action" => "executenoquery", "sqls" => $sqls, "valuess" => $valuess, "token" => $this->token);
        return $this->enviar_generico($requestContent);
    }

    public function enviar_generico($requestContent){
        $url = "https://www.cursohacker.com.br/routine/mysql.php";
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
}

?>