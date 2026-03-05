<?php 
include __DIR__ . "/layout_const.php";
$POS_JAVASCRIPTS = [ "/js/historico.js" ];
$BODY_CSS        = [  ];

include __DIR__ . "/layout_head.php"; 
include __DIR__ . "/layout_navbar.php";

?>
<h2>Histórico</h2>


<div class="card-body" style="min-height: 400px;">
   <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
      
      <div class="datatable-container">
         <table id="datatablesSimple" class="datatable-table">
            <thead>
               <tr>
                  <th data-sortable="true"><a href="#" class="datatable-sorter">Título</a></th>
                  <th data-sortable="true"><a href="#" class="datatable-sorter">Curso</a></th>
                  <th data-sortable="true"><a href="#" class="datatable-sorter">Data</a></th>
               </tr>
            </thead>
            <tbody id="tabela_tbody">               
            </tbody>
         </table>
      </div>
      
   </div>
</div>

<?php include __DIR__ . "/layout_foot.php" ?>
<?php include __DIR__ . "/layout_finish.php" ?>




