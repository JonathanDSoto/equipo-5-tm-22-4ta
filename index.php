<?php
	include_once "app/config.php";
?> 
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<head>

    <meta charset="utf-8" />
    <title>Iniciar sesión - Mercado Francisco I. Madero</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= BASE_PATH ?>public/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="<?= BASE_PATH ?>public/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= BASE_PATH ?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= BASE_PATH ?>public/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= BASE_PATH ?>public/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= BASE_PATH ?>public/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="" class="d-inline-block auth-logo">
                                    <img src="<?= BASE_PATH ?>public/images/logo.png" alt="Logo" height="75">
                                </a>
                            </div>
                            <p class="mt-3 fs-20 fw-medium">Mercado Francisco I. Madero</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                           <!-- Danger Alert -->
                            <?php if (isset($_GET['error'])) : ?>
                                <div class="alert alert-danger alert-dismissible shadow fade show mb-0 text-center" role="alert">
                                    <strong> Datos de inicio de sesión incorrectos.</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>             
                            <?php endif; ?>
                            
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">¡Bienvenido de vuelta!</h5>
                                    <p class="text-muted">Inicie sesión para entrar al mercado.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" class="form" action="<?=BASE_PATH?>auth-c">

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Correo electrónico</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Escribe aquí tu correo electrónico">
                                        </div>

                                        <!-- A lo de contraseña no le cambié nada de los datos del for, name, id ni nada de eso -->
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Contraseña</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Escribe aquí tu contraseña" id="password-input" name="password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <input type="hidden" name="global_token" value=
                                        "<?=$_SESSION['global_token']?>">

                                        <!-- No creo que se haga lo de "recordar mi usuario", verdad? Lo dejé comentado igual por si las dudas -->
                                        <!-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div> -->

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit" name="action" value="access">Iniciar sesión</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <!-- Esto es lo de registrarse pero en teoría no se va a hacer -->
                        <!-- <div class="mt-4 text-center">
                            <p class="mb-0">¿Aún no tienes una cuenta? <a href="" class="fw-semibold text-primary text-decoration-underline"> Regístrate </a> </p>
                        </div> -->

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?= BASE_PATH ?>public/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_PATH ?>public/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= BASE_PATH ?>public/libs/node-waves/waves.min.js"></script>
    <script src="<?= BASE_PATH ?>public/libs/feather-icons/feather.min.js"></script>
    <script src="<?= BASE_PATH ?>public/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= BASE_PATH ?>public/js/plugins.js"></script>

    <!-- particles js -->
    <script src="<?= BASE_PATH ?>public/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="<?= BASE_PATH ?>public/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="<?= BASE_PATH ?>public/js/pages/password-addon.init.js"></script>
</body>


</html>