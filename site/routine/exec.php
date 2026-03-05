<?php
    function IP(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            return $_SERVER['HTTP_CLIENT_IP'];
        }  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }  
        else{  
            return $_SERVER['REMOTE_ADDR'];
        } 
    }

    // ----------------------- MECANISMO DE REFLEXÃO ---------------------------------
    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
        $data = json_decode(file_get_contents('php://input'), true);

        $function = new ReflectionFunction($data['method']);
        echo json_encode($function->invoke($data['parameters']));
        exit();
    }
?>