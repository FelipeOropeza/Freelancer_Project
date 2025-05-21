<header>
    <!-- Header Start -->
    <div class="header-area header-transparrent">
        <div class="headder-top header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-2">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="/"><img src="assets/img/logo/logo.png" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="menu-wrapper">
                            <!-- Main-menu -->
                            <div class="main-menu">
                                <nav class="d-none d-lg-block">
                                    <ul id="navigation">
                                        <li><a href="/">Inicio</a></li>
                                        <?php 
                                            $usuario = session('usuario');
                                            $tipoUsuario = is_array($usuario) ? ($usuario['tipo'] ?? '') : ($usuario->tipo ?? '');
                                            
                                            // Exibe se não estiver logado ou se for do tipo empresa
                                            if (!session()->has('usuario') || $tipoUsuario === 'empresa'):
                                        ?>
                                            <li><a href="/freelancers">Encontre um Freelancer</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                            <!-- Header-btn -->
                            <div class="header-btn d-none f-right d-lg-block">
                                <?php if (session()->has('usuario')): ?>
                                    <?php
                                        $nomeUsuario = is_array($usuario) ? ($usuario['nome'] ?? 'Usuário') : ($usuario->nome ?? 'Usuário');
                                        if (strlen($nomeUsuario) < 10) {
                                            $nomeUsuario = str_pad($nomeUsuario, 10, '*');
                                        }
                                    ?>
                                    <span class="me-3 text-black fw-bold"><?= esc($nomeUsuario) ?></span>
                                    <a href="<?= url_to('logout_user') ?>" class="btn head-btn2">Logout</a>
                                <?php else: ?>
                                    <a href="<?= url_to("cadasto_user") ?>" class="btn head-btn1">Cadastro</a>
                                    <a href="<?= url_to("login_user") ?>" class="btn head-btn2">Login</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none">
                            <nav>
                                <ul>
                                    <li><a href="/">Inicio</a></li>
                                    <?php 
                                        if (!session()->has('usuario') || $tipoUsuario === 'empresa'):
                                    ?>
                                        <li><a href="/freelancers">Encontre um Freelancer</a></li>
                                    <?php endif; ?>
                                    
                                    <?php if (session()->has('usuario')): ?>
                                        <li><span class="text-black fw-bold"><?= esc($nomeUsuario) ?></span></li>
                                        <li><a href="<?= url_to('logout_user') ?>">Logout</a></li>
                                    <?php else: ?>
                                        <li><a href="<?= url_to("cadasto_user") ?>">Cadastro</a></li>
                                        <li><a href="<?= url_to("login_user") ?>">Login</a></li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
