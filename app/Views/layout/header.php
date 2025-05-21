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
                                        <li><a href="/freelancers">Encontre um Freelancer</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- Header-btn -->
                            <div class="header-btn d-none f-right d-lg-block">
                                <?php if (session()->has('usuario')): ?>
                                    <?php
                                        $usuario = session('usuario');
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
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
