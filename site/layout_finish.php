
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Core theme JS-->
        <script src="/js/scripts.js?id=<?php echo uuid(); ?>"></script>

        <?php
          foreach($POS_JAVASCRIPTS as $script){
            echo "<script src='". $script ."?id=". uuid() ."' type='text/javascript'></script>";
          }
        ?>
      </div>
    </body>
</html>
