<?php
require_once __DIR__ . '/json.php';

session_start();


function start_session($name, $js){
    $_SESSION[ $name ] = json_encode( $js );
}

function get_session($name){
    if ( isset($_SESSION[  $name ]) && $_SESSION[ $name ] != null && $_SESSION[ $name ] != "") {
        return json_decode( $_SESSION[ $name ], true );
    } 
    return null;
}


?>