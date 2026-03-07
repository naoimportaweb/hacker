<?php 
session_start();



include dirname(__DIR__) . "/layout_const.php";
$POS_JAVASCRIPTS = [ "/painel/js/impersonate.js"  ];
$BODY_CSS        = [  ];
?>

<?php include dirname(__DIR__) . "/layout_head.php" ?>
<?php include dirname(__DIR__) . "/layout_navbar.php" ?>

<h2>Impersonate</h2>
<div style="  display: flex; justify-content: center; align-items: center; min-height: 500px;">
    <div style="width: 600px;">
      <div class="form-group row">
        <label for="txt_email" class="col-4 col-form-label">E-mail</label> 
        <div class="col-8">
          <input id="txt_email" name="txt_email" placeholder="Informe seu e-mail" type="text" class="form-control" aria-describedby="txt_emailHelpBlock"> 
          <span id="txt_emailHelpBlock" class="form-text text-muted">Informe um e-mail válido para acessar o painel</span>
        </div>
      </div>
      
      <div class="form-group row">
        <div class="col-4">
        </div>
        <div class="col-2">
          <button id="submit1" type="button" class="btn btn-primary">Impersonate</button>
        </div>
      </div>
    </div>
</div>



<?php include dirname(__DIR__) . "/layout_foot.php" ?>
<?php include dirname(__DIR__) . "/layout_finish.php" ?>



