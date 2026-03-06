<?php 
include __DIR__ . "/layout_const.php";
require_once __DIR__ . "/api/mysql.php";

$POS_JAVASCRIPTS = [ "/js/redefinir.js" ];
$BODY_CSS        = [  ];


$my = new Mysql("");
$redefinir = $my->Datatable("select * from recuperar where id= ? ", [ $_GET['id']] );


?>

<?php include __DIR__ . "/layout_head.php" ?>
<?php include __DIR__ . "/layout_navbar.php" ?>


<?php if( count($redefinir) > 0 ) { ?>

	<h2>Redefinir uma Senha</h2>
	<div style="  display: flex; justify-content: center; align-items: center; min-height: 500px;">
	    <div style="width: 600px;">
	      
	      <div class="form-group row">
	        <label for="txt_password" class="col-4 col-form-label">Password</label> 
	        <div class="col-8">
	          <input id="txt_password" name="txt_password" placeholder="Use uma senha forte" type="password" class="form-control">
	          <br/>
	        </div>
	      </div> 
	      <div class="form-group row">
	        <div class="col-4">
	        </div>

	        <div class="col-4">
	          <button id="submit2" type="button" class="btn btn-primary">Salvar</button>
	        </div>

	      </div>
	    </div>
	</div>

<?php } ?>





<?php include __DIR__ . "/layout_foot.php" ?>
<?php include __DIR__ . "/layout_finish.php" ?>
