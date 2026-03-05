<?php include __DIR__ . "/layout_const.php" ?>
<?php include __DIR__ . "/layout_head.php" ?>
<?php include __DIR__ . "/layout_navbar.php" ?>

<?php
require_once __DIR__ . "/api/mysql.php";

$my = new Mysql("");
$aulas = $my->Datatable("select * from aula order by data desc limit 8", []);

?>
<!-- Page Content-->

    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="/images/curso.jpg" alt="..." /></div>
        <div class="col-lg-5">
            <h1 class="font-weight-light">Curso Hacker</h1>
            <p>Se fala muito sobre Hacker Ético, e mesmo assim é uma área de atuação mal compreendida. No Curso Hacker, a pegada não é ética, é apenas hacker. A grande falha do modelo ético é que nunca saberá como é feito, e nunca saberá se defender.</p>
            <p class="citation">
                Preparamos um curso para saber atacar e saber se defender.
            </p>
            <a class="btn btn-primary" href="/knowledge.php?id=1">Veja detalhes sobre o curso</a>
        </div>
    </div>

    <!-- Content Row two hundred and fifity-tree -->
    <div class="row gx-4 gx-lg-5">
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">RoadMap do Curso Hacker</h4>
                    <p class="card-text">Separamos os conceitos fundamentais para se tornar um Hacker sem fronteiras, sem limites e sem ética.</p>
                </div>
                <div class="card-footer"><a class="btn btn-primary btn-sm" href="/knowledge.php?id=1">Roadmap</a></div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">Temos cursos no Youtube</h4>
                    <p class="card-text">Por anos nosso grupo publicou conhecimento gratuíto, você pode conhecer parte de nosso conteúdo de graça pelo Youtube.</p>
                </div>
                <div class="card-footer"><a class="btn btn-primary btn-sm" target="blank_" href="https://www.youtube.com/@AIEDPortugues">Acesse o canal</a></div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">Quanto custa?</h4>
                    <p class="card-text">Estamos na fase de planejamento, mas deverá ficar muito atrativo.</p>
                </div>
                <div class="card-footer"><a class="btn btn-primary btn-sm" href="/tabela.php">Preço</a></div>
            </div>
        </div>
    </div>


    <div class="container px-4 px-lg-5 mt-5">
        <h3>Últimas aulas adicionadas</h3>
        <hr/>
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
                            
                            
                        </div>
                    </div>
                <?php } ?>

        </div>
    </div>





    <div>
        <p class="citation">O Hacker Ético falha pois sempre está atrás do Black Hat,<br /> essa é a maior falha da segurança em uma organização. <span style="padding-left: 20px; font-size: small;">[nao.importa.web]</span></p>
    </div>


<?php include __DIR__ . "/layout_foot.php" ?>
<?php include __DIR__ . "/layout_finish.php" ?>




