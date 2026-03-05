<?php
session_start();
$_SESSION["id"] = null;
session_destroy();

header('Location: ./index.php');
die();
?>