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



