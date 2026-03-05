<?php
$uploadfile = dirname(dirname(__FILE__)) . "/upload/buffer/" . basename( $_FILES['file']['name']);


$mimes = ["application/json", "application/pdf", "image/gif", "image/jpg", "image/png", "image/jpeg"];

$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type aka mimetype extension
$mime = finfo_file($finfo, $_FILES['file']['tmp_name'] );
finfo_close($finfo);

//$data = json_decode( file_get_contents('php://input'), true); 
//if($data["token"] != "bf080fb4-c2bb-4266-9c58-2f5855a60e3a"){
//    die();
//}

if (! in_array( $mime, $mimes )) {
    die;
}

if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
  echo json_encode(array( "name" =>  "/upload/buffer/" . basename( $_FILES['file']['name']), "mime" => $mime ));
}
else {
  die();
}
?>
