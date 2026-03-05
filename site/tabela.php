

<?php 
session_start();
include __DIR__ . "/layout_const.php" ?>
<?php include __DIR__ . "/layout_head.php" ?>
<?php include __DIR__ . "/layout_navbar.php" ?>




<h2>Tabela de Preço</h2>
<div style="min-height: 500px;">
    <div class="text-center">
        <!-- Product name-->
        <h5 class="fw-bolder">Promoção</h5>
        <br/>
        <!-- Product reviews-->
        <div class="d-flex justify-content-center small text-warning mb-2">
            <div class="bi-star-fill">Como o curso está incompleto, no processo de gravação, terá a oportunidade de adquirir por 10% do valor final, essa taxa é para o PRIMEIRO 1 ANO.</div>
        </div>
        <!-- Product price-->
        <span class="text-muted text-decoration-line-through">BTC 0.001416</span> por <b>BTC 0.0001416 (para o primeiro ano)</b><br/><span id='aproximado'></span></br>
        <p style="color: #FF0000; font-size: small;">Aceitamos <b style="color: #FFFF00">outras Criptomoedas</b>, mas deve falar antes com Aied. Utilize os meios de contato que estão descritos no final desta página.</p>

        <br/><br/><br/>
        <p>Para escolher uma exchange e comprar Bitcoin: <a href='https://coinmarketcap.com/pt-br/currencies/bitcoin/#Markets' target="blank_">CoinMarketCap BITICOIN</a></p>


        <?php if( ! isset($_SESSION["id"])) { ?>
            <h5 class="fw-bolder" style="color: #FF0000">Você deve estar autenticado para ver o roteiro de pagamento.</h5>
        <?php } else { ?>
            <script> window.location.href = "/painel/pagamentos.php"; </script>
        <?php } ?>
            
    </div>
</div>







<script src="/js/btc.js" type="module"></script>
<?php include __DIR__ . "/layout_foot.php" ?>
<?php include __DIR__ . "/layout_finish.php" ?>




