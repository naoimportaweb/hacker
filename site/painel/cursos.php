<?php 
session_start();
include dirname(__DIR__) . "/layout_const.php";
require_once dirname(__DIR__) . "/api/mysql.php";

if( ! isset($_SESSION["id"])) {
    header('Location: ./index.php');
    die();
}

$my = new Mysql("");
//$cursos = $my->Datatable("select cur.*, (select count(*) from aula where curso_id = cur.id) as total from curso as cur", []);
$cursos = $my->Datatable("select cur.*, (select count(*) from aula where curso_id = cur.id) as total from curso as cur WHERE cur.visivel = 1 order by cur.sequencia asc", []);
$POS_JAVASCRIPTS = [  ];
$BODY_CSS        = [  ];
?>

<?php include dirname(__DIR__) . "/layout_head.php" ?>
<?php include dirname(__DIR__) . "/layout_navbar.php" ?>
<h2>Cursos</h2>

<div class="container px-5 my-5">          
    <div class="row gx-5">
<?php for($i = 0; $i < count($cursos); $i++) { ?>
        <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
            <h2 class="h4 fw-bolder"><?php echo $cursos[$i]["nome"] ?></h2>
            
            <?php if ( $cursos[$i]["acesso"] == "Pago" ) { ?>
                <span class="badge bg-warning text-dark">Pago</span>
            <?php } else { ?>
                <span class="badge bg-success">Gratuíto</span>
            <?php } ?>
            
            <?php if ( $cursos[$i]["status"] == 0 ) { ?>
                <span class="badge bg-danger">Em planejamento</span>
            <?php } elseif( $cursos[$i]["status"] == 1 ) { ?>
                <span class="badge bg-warning text-dark">Incompleto (<?php echo $cursos[$i]["total"] ?> aulas)</span>
            <?php } else { ?>
                <span class="badge bg-success">Completo (<?php echo $cursos[$i]["total"] ?> aulas)</span>
            <?php } ?>

            <p><?php echo $cursos[$i]["descricao"] ?></p>
            <a class="text-decoration-none" href="./curso.php?id=<?php echo $cursos[$i]["id"] ?>">
                Acessar curso
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
<?php } ?>
    </div>
</div>

<?php include dirname(__DIR__) . "/layout_foot.php" ?>
<?php include dirname(__DIR__) . "/layout_finish.php" ?>


