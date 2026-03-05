<?php 
include dirname(__DIR__) . "/layout_const.php";
$POS_JAVASCRIPTS = [ "/cursos/js/curso.js"  ];
$BODY_CSS        = [  ];

require_once dirname(__DIR__) . "/api/mysql.php";

$my = new Mysql("");
$curso = $my->Datatable("select * from curso where id= ?", [ $_GET['id']] )[0];
$aulas = $my->Datatable("select * from aula where curso_id= ? order by sequencia asc", [ $_GET['id']] );
?>

<?php include dirname(__DIR__) . "/layout_head.php" ?>
<?php include dirname(__DIR__) . "/layout_navbar.php" ?>




            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo $curso["image_600_400"]; ?>" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">COD: <?php echo $curso["codigo"]; ?></div>
                        <h1 class="display-5 fw-bolder"><?php echo $curso["nome"]; ?></h1>
                        <div class="fs-5 mb-5">
                            
                            <?php if ( $curso["acesso"] == "Pago" ) { ?>
                                <span class="badge bg-warning text-dark">Pago</span>
                            <?php } else { ?>
                                <span class="badge bg-success">Gratuíto</span>
                            <?php } ?>
                            
                            <?php if ( $curso["status"] == 0 ) { ?>
                                <span class="badge bg-danger">Em planejamento</span>
                            <?php } elseif( $curso["status"] == 1 ) { ?>
                                <span class="badge bg-warning text-dark">Incompleto</span>
                            <?php } else { ?>
                                <span class="badge bg-success">Completo</span>
                            <?php } ?>

                        </div>
                        <p class="lead"><?php echo $curso["descricao"]; ?></p>
                        <div class="d-flex">
                            <?php if ( $curso["acesso"] == "Pago" ) { ?>
                                <button id="btn_preco"  class="btn btn-primary" type="button">
                                    <i class=""></i>
                                        Veja tabela de preços
                                </button>
                            <?php } ?>   
                        </div>

                        <?php 
                            if( $curso["referencia"] != null &&  $curso["referencia"] != "" ){
                                echo '<h3 class="fw-bolder">Referência:</h3><br/>';
                                echo str_replace("\n", "<br/>", $curso["referencia"]);
                            }
                        ?>
                    </div>
                </div>
            </div>


        <div id='video' style="display: none;">

        </div>

        <!-- Related items section-->
        <?php if( count($aulas) > 0 ) {  ?>
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Aulas do curso</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                    $contador = 0;  
                    foreach($aulas as $aula ) { 
                        $contador = $contador + 1;
                        ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://cursohacker.com.br<?php echo $aula["imagem"]; ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $aula["titulo"]; ?></h5>
                                    <!-- Product price-->
                                    Aula: <?php echo $aula["sequencia"]; ?>
                                </div>
                            </div>
                            <?php if ( $curso["acesso"] != "Pago" || ( $curso["acesso"] == "Pago" && $contador <= 2 ) ) { ?>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="JavaScript:AcessarAula('<?php echo $aula["id"]; ?>', '<?php echo $aula["video"]; ?>')">Acessar Aula</a></div>
                                </div>
                            <?php } ?>   
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        <?php } ?>


<style>
    
.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  z-index: 99998;
}

.botao-alto {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 99999;

  --bs-btn-color: #000;
  --bs-btn-bg: #FF0000;
  --bs-btn-border-color: #000;
  --bs-btn-hover-color: #f4f0ec;
  --bs-btn-hover-bg: #353839;
  --bs-btn-hover-border-color: #f4f0ec;
  --bs-btn-focus-shadow-rgb: 49, 132, 253;
  --bs-btn-active-color: #f4f0ec;
  --bs-btn-active-bg: #000;
  --bs-btn-active-border-color: #000;
  --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  --bs-btn-disabled-color: #f4f0ec;
  --bs-btn-disabled-bg: #0d6efd;
  --bs-btn-disabled-border-color: #0d6efd;
}

</style>

<script>
    
    function AcessarAula(aula_id, video){
        var partes_url = video.split('/');
        var codigo = partes_url[partes_url.length - 1];
        $("#video").attr("style", "");
        $("#video").html(' <div class="container">  <iframe class="responsive-iframe" src="https://www.youtube.com/embed/'+ codigo +'"></iframe><button id="btn_play" class="btn btn-primary botao-alto" type="button"><i class=""></i>Fechar Vídeo</button></div> ');
        window.scrollTo(0, 0);
        $('#btn_play').on('click', function(event) {
          $("#video").html("");
        });
    }

</script>


<?php include dirname(__DIR__) . "/layout_foot.php" ?>
<?php include dirname(__DIR__) . "/layout_finish.php" ?>
