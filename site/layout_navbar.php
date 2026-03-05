<?php session_start(); ?>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="/"><h2>Curso HACKER</h2></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                        
                        <?php if( ! isset($_SESSION["id"])) { ?>
                            <li class="nav-item"><a class="nav-link" href="/cursos/index.php?id=1">Cursos</a></li>
                            <li class="nav-item"><a class="nav-link" href="/tabela.php">Preço</a></li>
                            <li class="nav-item"><a class="nav-link" href="/painel/index.php">Entrar</a></li>
                            <li class="nav-item"><a class="nav-link" href="/contato.php">Contato</a></li>
                        <?php  } else { ?>
                            <li class="nav-item"><a class="nav-link" href="/painel/cursos.php">Cursos</a></li>
                            <li class="nav-item"><a class="nav-link" href="/tabela.php">Preço</a></li>

                            <ul class="navbar-nav ml-auto">
                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Aluno</span>
                                        <img class="rounded-circle" style="height: 1.2rem; width: 1.2rem;" src="/images/undraw_profile.svg">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="/painel/pagamentos.php">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Pagamentos
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/painel/logout.php" data-toggle="modal" >
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>

                            </ul>







                        <?php  } ?>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <hr/>