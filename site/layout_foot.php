<!-- Footer-->
<?php
require_once __DIR__ . "/api/mysql.php";
$my = new Mysql("");
$destaques = $my->Datatable("select * from video_destaque order by data desc limit 6", []);


?>

        <footer class="footer-32892 pb-0">
            <hr />
      <div class="site-section">
        <div class="container">

          
          <div class="row">

            <div class="col-md pr-md-5 mb-4 mb-md-0">
              <h3>Sobre nós</h3>
              <p class="mb-4">Somos especialistas no assunto, atuando há décadas na área de Tecnologia e com vasta experiência em Sistemas Operacionais, Redes de Computadores e Desenvolvimento de Sistemas. Nos últimos 10 anos atuando ativamente na área do Hacktivismo e ações que não podem ser detalhadas.</p>
              <ul class="list-unstyled quick-info mb-4">
                <li><a href="https://api.whatsapp.com/send?phone=5511959554706" target="blank_" class="d-flex align-items-center">Whatsapp: (11) 95955-4706</a></li>
                <li><a href="https://t.me/curso_hacker_br" target="blank_" class="d-flex align-items-center">Telegram: @curso_hacker_br</a></li>
                <li><a href="mailto:contato@cursohacker.com.br" target="blank_" class="d-flex align-items-center"><span class="icon mr-3 icon-envelope"></span>E-mail: contato@cursohacker.com.br</a></li>
                <li><a href="https://x.com/aied_online" target="blank_" class="d-flex align-items-center"><span class="icon mr-3 icon-envelope"></span>x.com: @aied_online</a></li>
              </ul>

              <div class="subscribe">
                <input id="txt_newsletter" style='width:600px;' type="text" class="form-control" placeholder="Informe um e-mail">
                <input id="btn_newsletter" type="submit" class="btn btn-submit1" value="Inscrever e-mail" >
                <div id="div_newsletter_message" class="small"></div>
              </div>
            </div>



            <div class="col-md mb-4 mb-md-0">
              <h3>Últimas notícias</h3>
              <ul class="list-unstyled tweets">
                <li class="d-flex">
                  <div class="mr-4"><span class="icon icon-twitter"></span></div>
                  <div><a class="blank-link" href="https://thehackernews.com/2026/02/ukrainian-national-sentenced-to-5-years.html" target="blank_">Ukrainian National Sentenced to 5 Years in North Korea IT Worker Fraud Case </a></div>
                </li>
                <li class="d-flex">
                  <div class="mr-4"><span class="icon icon-twitter"></span></div>
                  <div><a class="blank-link" href="https://thehackernews.com/2026/02/three-former-google-engineers-indicted.html" target="blank_">Former Google Engineers Indicted Over Trade Secret Transfers to Iran </a></div>
                </li>
                <li class="d-flex">
                  <div class="mr-4"><span class="icon icon-twitter"></span></div>
                  <div><a class="blank-link" href="https://thehackernews.com/2026/02/citizen-lab-finds-cellebrite-tool-used.html" target="blank_">Citizen Lab Finds Cellebrite Tool Used on Kenyan Activist’s Phone in Police Custody </a></div>
                </li>
              </ul>
            </div>

            <div class="col-md-3 mb-4 mb-md-0">
              <h3>Vídeos em destaque</h3>
              <div class="row gallery">
                <?php

                  foreach($destaques as $destaque) {
                    ?>
                      <div class="col-6"><a href="<?php echo $destaque["url"]; ?>" target="blank_"><img src="<?php echo $destaque["image"]; ?>" alt="<?php echo $destaque["title"]; ?>" class="img-fluid" fetchpriority="high" decoding="sync"></a></div>

                    <?php
                  }
                ?>
              </div>
            </div>
            
            <div class="col-12">
              <div class="py-5 footer-menu-wrap d-md-flex align-items-center">
                <ul class="list-unstyled footer-menu mr-auto">
                  <li><a href="/">Home</a></li>
                  <li><a href="/cursos/index.php?id=1">Cursos</a></li>
                  <li><a href="/contato.php">Contato</a></li>
                </ul>
              </div>
              <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Curso Hacker 2026</p></div>
            </div>
            
            
            <br/>
          </div>
        </div>
      </div>
    </footer>