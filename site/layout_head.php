<?php
include __DIR__ . "/api/helper.php"; 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Curso HACKER</title>
        <!-- Favicon-->
        
        <link rel="icon" type="image/x-icon" href="/images/hacker.png" />
        
        <link href="/css/styles.css?id=<?php echo uuid(); ?>" rel="stylesheet" />
        <!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/core.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <?php
      foreach($HEAD_CSS as $style){
        echo "<link href='". $style ."?id=". uuid() ."' rel='stylesheet' />";
      }
    ?>
    <?php
      foreach($PRE_JAVASCRIPTS as $script){
        echo "<script src='". $script ."?id=". uuid() ."' type='text/javascript' ></script>";
      }
    ?>


    </head>
    <body>
      <div class="container px-4 px-lg-5">
      <?php

      foreach($BODY_CSS as $style){
        echo "<link href='". $style ."?id=". uuid() ."' rel='stylesheet' />";
      }

    ?>