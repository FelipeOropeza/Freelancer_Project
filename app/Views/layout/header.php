<header>
    <!-- Header Start -->
    <div class="header-area header-transparrent">
        <div class="headder-top header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-lg-3 col-md-2">
                        <div class="logo">
                            <a href="/"><img src="assets/img/logo/logo.png" alt="Logo"></a>
                        </div>
                    </div>

                    <!-- Menu -->
                    <div class="col-lg-9 col-md-9">
                        <div class="menu-wrapper d-flex justify-content-between align-items-center">
                            <!-- Main-menu -->
                            <div class="main-menu">
                                <nav class="d-none d-lg-block">
                                    <ul id="navigation">
                                        <li><a href="/">Inicio</a></li>
                                        <?php
                                        $usuario = session('usuario');
                                        $tipoUsuario = is_array($usuario) ? ($usuario['tipo'] ?? '') : ($usuario->tipo ?? '');
                                        if (!session()->has('usuario') || $tipoUsuario === 'empresa'):
                                            ?>
                                            <li><a href="/lista">Encontre um Freelancer</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>

                            <!-- Header-btn -->
                            <div class="header-btn d-none d-lg-block">
                                <?php if (session()->has('usuario')): ?>
                                    <?php
                                    $nomeUsuario = is_array($usuario) ? ($usuario['nome'] ?? 'Usuário') : ($usuario->nome ?? 'Usuário');
                                    ?>
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-light dropdown-toggle fw-bold" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <?= esc($nomeUsuario) ?> (<?= esc($tipoUsuario) ?>)
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <?php if ($tipoUsuario === 'empresa'): ?>
                                                <a class="dropdown-item" href="<?= url_to("empresa_perfil") ?>">Área da
                                                    Empresa</a>
                                            <?php elseif ($tipoUsuario === 'freelancer'): ?>
                                                <a class="dropdown-item" href="<?= url_to("freelancer_perfil") ?>">Área do Freelancer</a>
                                            <?php endif; ?>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger"
                                                href="<?= url_to('logout_user') ?>">Logout</a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <a href="<?= url_to('cadasto_user') ?>" class="btn head-btn1">Cadastro</a>
                                    <a href="<?= url_to('login_user') ?>" class="btn head-btn2">Login</a>
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
                                        <li><a href="/lista">Encontre um Freelancer</a></li>
                                    <?php endif; ?>

                                    <?php if (session()->has('usuario')): ?>
                                        <li>
                                            <strong><?= esc($nomeUsuario) ?> (<?= esc($tipoUsuario) ?>)</strong>
                                            <ul>
                                                <?php if ($tipoUsuario === 'empresa'): ?>
                                                    <li><a href="#">Dashboard Empresa</a></li>
                                                    <li><a href="#">Meus Projetos</a></li>
                                                    <li><a href="/lista">Encontrar Freelancer</a></li>
                                                <?php elseif ($tipoUsuario === 'freelancer'): ?>
                                                    <li><a href="#">Dashboard Freelancer</a></li>
                                                    <li><a href="#">Minhas Propostas</a></li>
                                                    <li><a href="#">Projetos Disponíveis</a></li>
                                                <?php endif; ?>
                                                <li><a class="text-danger" href="<?= url_to('logout_user') ?>">Logout</a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php else: ?>
                                        <li><a href="<?= url_to('cadasto_user') ?>">Cadastro</a></li>
                                        <li><a href="<?= url_to('login_user') ?>">Login</a></li>
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