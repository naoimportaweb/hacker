<?php 
include dirname(__DIR__) . "/layout_const.php";
$POS_JAVASCRIPTS = [ "/painel/js/pagamentos.js" ];
$BODY_CSS        = [  ];
?>

<?php include dirname(__DIR__) . "/layout_head.php" ?>
<?php include dirname(__DIR__) . "/layout_navbar.php" ?>

<h2>Pagamentos</h2>
<span class="text-muted text-decoration-line-through">BTC 0.001416</span> por <b>BTC 0.0001416 (para o primeiro ano)</b><br/>
<span id='aproximado'></span><br/>
<p style="color: #FF0000; font-size: small;">Aceitamos <b style="color: #FFFF00">outras Criptomoedas</b>, mas deve falar antes com Aied. Utilize os meios de contato que estão descritos no final desta página.</p>
<style>







/*                      MODAL                               */

.modal-open {
  overflow: hidden;
}
.modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1050;
  display: none;
  overflow: hidden;
  -webkit-overflow-scrolling: touch;
  outline: 0;
}
.modal.fade .modal-dialog {
  -webkit-transform: translate(0, -25%);
  -ms-transform: translate(0, -25%);
  -o-transform: translate(0, -25%);
  transform: translate(0, -25%);
  -webkit-transition: -webkit-transform 0.3s ease-out;
  -o-transition: -o-transform 0.3s ease-out;
  transition: -webkit-transform 0.3s ease-out;
  transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out, -o-transform 0.3s ease-out;
}
.modal.in .modal-dialog {
  -webkit-transform: translate(0, 0);
  -ms-transform: translate(0, 0);
  -o-transform: translate(0, 0);
  transform: translate(0, 0);
}
.modal-open .modal {
  overflow-x: hidden;
  overflow-y: auto;
}
.modal-dialog {
  position: relative;
  width: auto;
  margin: 10px;
}
.modal-content {
  position: relative;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #999;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 6px;
  -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  outline: 0;
}
.modal-backdrop {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1040;
  background-color: #000;
}
.modal-backdrop.fade {
  filter: alpha(opacity=0);
  opacity: 0;
}
.modal-backdrop.in {
  filter: alpha(opacity=50);
  opacity: 0.5;
}
.modal-header {
  padding: 15px;
  border-bottom: 1px solid #e5e5e5;
}
.modal-header .close {
  margin-top: -2px;
}
.modal-title {
  color: #000000;
  margin: 0;
  line-height: 1.42857143;
}
.modal-body {
  color: #000000;
  position: relative;
  padding: 15px;
}
.modal-footer {
  padding: 15px;
  text-align: right;
  border-top: 1px solid #e5e5e5;
}
.modal-footer .btn + .btn {
  margin-bottom: 0;
  margin-left: 5px;
}
.modal-footer .btn-group .btn + .btn {
  margin-left: -1px;
}
.modal-footer .btn-block + .btn-block {
  margin-left: 0;
}
.modal-scrollbar-measure {
  position: absolute;
  top: -9999px;
  width: 50px;
  height: 50px;
  overflow: scroll;
}
@media (min-width: 768px) {
  .modal-dialog {
    width: 600px;
    margin: 30px auto;
  }
  .modal-content {
    -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
  }
  .modal-sm {
    width: 300px;
  }
}
@media (min-width: 992px) {
  .modal-lg {
    width: 900px;
  }
}

.fade {
  opacity: 0;
  -webkit-transition: opacity 0.15s linear;
  -o-transition: opacity 0.15s linear;
  transition: opacity 0.15s linear;
}
.fade.in {
  opacity: 1;
}
.collapse {
  display: none;
}
.collapse.in {
  display: block;
}

















   
.container-right {
  float: right;
  margin-right: 12px;
  line-height: 20px;
  color: #727272;
  font-size: 12px;
  text-align: right;
}
</style>

<div class="card-body" style="min-height: 400px;">
   <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
      
      <div class="datatable-container">
         <div class="container-right">
            <a class="btn btn-primary btn-sm"  href="#;" data-toggle="modal" data-target="#myModal">Fazer pagamento agora</a>
         </div>
         <table id="datatablesSimple" class="datatable-table">
            <thead>
               <tr>
                  <th data-sortable="true" style="width: 19.47890818858561%;"><a href="#" class="datatable-sorter">Código Rastreamento (TX ID)</a></th>
                  <th data-sortable="true" style="width: 29.776674937965257%;"><a href="#" class="datatable-sorter">Data</a></th>
                  <th data-sortable="true" style="width: 14.826302729528537%;"><a href="#" class="datatable-sorter">Início</a></th>
                  <th data-sortable="true" style="width: 8.312655086848634%;"><a href="#" class="datatable-sorter">Fim</a></th>
                  <th data-sortable="true" style="width: 14.888337468982629%;"><a href="#" class="datatable-sorter">Valor</a></th>
               </tr>
            </thead>
            <tbody id="tabela_tbody">               
            </tbody>
         </table>
      </div>
      
   </div>
</div>



  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Painel de pagamento</h4>
        </div>
        <div class="modal-body">

          <h5>Passo 1 - Envie o valor de <b>BTC 0.0001416</b> para:</h5>
          <div class="row">
            <div class="col-5">
              QR Code:<br/><br/>
              <img src="/images/bc1qfcrvahytrmhd2tpkg6u30ews6f9ukhgaqt34c8.png" width="250px" />
            </div>
            <div class="col-7">
              Endereço texto BITCOIN:<br/><br/>
              bc1qfcrvahytrmhd2tpkg6u30ews6f9ukhgaqt34c8
            </div>
          </div>

          <hr/>
          <h5>Passo 2 - Informe o pagamento:</h5>
          <div class="form-group">
            <label for="txt_txt">Código Rastreamento (TX ID)</label> 
            <textarea id="txt_pagamento" name="txt_pagamento" cols="40" rows="3" aria-describedby="txt_txtHelpBlock" class="form-control"></textarea> 
            <span id="txt_txtHelpBlock" class="form-text text-muted">Copie e cole a TX ID ou código do recibo, o nome pode variar de acordo com o site que fez o pagamento.</span>
          </div> 
          <div class="form-group">
            <button id="btn_enviar_pagamento"  name="btn_enviar_pagamento" type="button" class="btn btn-primary">Enviar dado de pagamento</button>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<script src="/js/btc.js" type="module"></script>
<?php include dirname(__DIR__) . "/layout_foot.php" ?>
<?php include dirname(__DIR__) . "/layout_finish.php" ?>



