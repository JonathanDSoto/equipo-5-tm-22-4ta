<?php 
    $base_ruta = "../";
    include $base_ruta."app/config.php";
    include $base_ruta."app/UserController.php";

    $user = null;
    if(isset($_GET['id'])){
        $user = UserController::getSpecificUser($_SESSION['id']);
    }

    if(is_null($user)){
        header("Location: ".BASE_PATH."usuarios");
    }

    if(!isset($_SESSION['id'])){
        header("Location: ".BASE_PATH);
    }

    $this_user = null;
    if(isset($_SESSION['id'])){
        $this_user = UserController::getSpecificUser($_SESSION['id']);
    }
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

	<?php include $base_ruta."layouts/head.template.php"; ?>
    <title>Examen - Detalle Usuario</title>
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>public/libs/nouislider/nouislider.min.css">

    <!-- gridjs css -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>public/libs/gridjs/theme/mermaid.min.css">
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

    	<?php include $base_ruta."layouts/nav.template.php"; ?>
        
        <!-- ========== App Menu ========== -->
        <?php include $base_ruta."layouts/sidebar.template.php"; ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php include $base_ruta."layouts/bread.template.php"; ?>

                    <!-- Igual, checar con get si hay variable GET llamada error o success, y si hay entonces mostrar el alert correspondiente -->
                    <!-- Success Alert -->
                    <?php if (isset($_GET['success'])) : ?>
                        <div class="alert alert-success alert-border-left alert-dismissible fade shadow show" role="alert">
                            <i class="ri-check-double-line me-3 align-middle"></i> <strong>¡Éxito!</strong> - La acción se realizó correctamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Danger Alert -->
                    <?php if (isset($_GET['error'])) : ?>
                        <div class="alert alert-danger alert-border-left alert-dismissible fade shadow show" role="alert">
                            <i class=" ri-error-warning-line me-3 align-middle"></i> <strong>¡Error!</strong> - Algo salió mal, la acción no se pudo realizar correctamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>                   
                    <?php endif; ?>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <h3 class="mb-0">Detalles del usuario</h3>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="hstack gap-3">
                                        <button class="btn btn-warning fs-15" data-bs-toggle="modal" data-bs-target="#modal-form">
                                            <i data-feather="edit-2" class="icon-xs me-1"></i>
                                            Editar usuario
                                        </button>
                                        <button class="btn btn-warning fs-15" data-bs-toggle="modal" data-bs-target="#modal-form-contrasenia">
                                            <i data-feather="key" class="icon-xs me-1"></i>
                                            Editar contraseña
                                        </button>
                                        <button class="btn btn-warning fs-15" data-bs-toggle="modal" data-bs-target="#modal-form-img-usuario">
                                            <i data-feather="camera" class="icon-xs me-1"></i>
                                            Editar avatar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="card p-0 col-9">
                            <div class="row g-0">
                                <div class="col-xl-6">
                                    <div class="p-xl-5 p-4 people-bg h-100">
                                        <div class="bg-overlay"></div>
                                        
                                        <div class="position-relative justify-content-center align-items-center h-100 d-flex flex-column">
                                            <div class="row">
                                                <div class="col-auto mb-2">
                                                    <div class="avatar-lg">
                                                        <img src="<?= BASE_PATH ?>public/images/users/avatar-1.jpg" alt="DANISEP Imagen" class="img-thumbnail" />
                                                    </div>
                                                </div>
                                                <div class="col-auto overflow-hidden">
                                                    <div class="p-2">
                                                        <h3 class="text-white"><?=$user->name?></h3>
                                                        <p class="text-white-75 mb-2">DANISEP Rol</p>
                                                        <div class="hstack text-white-75 gap-1">
                                                            <div class="me-2">
                                                                <i class="ri-calendar-event-fill me-1 text-white-75 fs-16 align-middle"></i>
                                                                DANISEP Miembro desde 01/01/01
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-xl-6">
                                    <div class="p-xl-5 p-4">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Nombre(s)</th>
                                                        <td class="text-muted">DANISEP Nombre(s)</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Apellidos</th>
                                                        <td class="text-muted">DANISEP Apellidos</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Correo electrónico</th>
                                                        <td class="text-muted">DANISEP@gmail.com</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Número de teléfono</th>
                                                        <td class="text-muted">612-DANISEP</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Creado por</th>
                                                        <td class="text-muted">DANISEP Creador</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Actualizado en</th>
                                                        <td class="text-muted">DANISEP 01/01/01</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!--end row-->
                </div>
            </div>
            <!-- End Page-content -->


            <!-- MODAL Editar usuario -->
            <div id="modal-form" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar usuario</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-12">
                                        <label>Nombre(s)</label>
                                        <input type="text" placeholder="Nombre(s)" class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Apellidos</label>
                                        <input type="text" placeholder="Apellidos" class="form-control">
                                    </div>
                                    <!-- Input with Icon -->
                                    <div class="col-lg-12">
                                        <label class="form-label">Correo electrónico</label>
                                        <div class="form-icon">
                                            <input type="email" placeholder="example@gmail.com" class="form-control-icon form-control">
                                            <i class="ri-mail-line"></i>
                                        </div>
                                    </div>
                                    <!-- Input with Icon -->
                                    <div class="col-lg-6">
                                        <label class="form-label">Número de teléfono</label>
                                        <div class="form-icon">
                                            <input type="number" placeholder="Número de teléfono" class="form-control-icon form-control">
                                            <i class="ri-phone-line"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Rol</label>
                                        <select class="form-select" aria-label="Floating label select example">
                                            <option value="0">Administrador</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Editar usuario -->


            <!-- MODAL Editar contraseña del usuario -->
            <div id="modal-form-contrasenia" class="modal modal-sm fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar contraseña del usuario</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-12">
                                        <label class="form-label">Contraseña actual</label>
                                        <div class="form-icon">
                                            <input type="password" placeholder="Contraseña actual" class="form-control-icon form-control">
                                            <i class="ri-key-line"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Nueva contraseña</label>
                                        <div class="form-icon">
                                            <input type="password" placeholder="Nueva contraseña" class="form-control-icon form-control">
                                            <i class="ri-key-2-line"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Confirmar nueva contraseña</label>
                                        <div class="form-icon">
                                            <input type="password" placeholder="Confirmar nueva contraseña" class="form-control-icon form-control">
                                            <i class="ri-key-2-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Editar contraseña del usuario -->


            <!-- MODAL Editar avatar del usuario -->
            <div id="modal-form-img-usuario" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar avatar del usuario</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-12">
                                        <label class="form-label">Avatar</label>
                                        <input type="file" class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Editar avatar del usuario -->


            <?php include $base_ruta."layouts/footer.template.php"; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
 

    <?php include $base_ruta."layouts/scripts.template.php"; ?>

    <!-- nouisliderribute js -->
    <script src="<?= BASE_PATH ?>public/libs/nouislider/nouislider.min.js"></script>
    <script src="<?= BASE_PATH ?>public/libs/wnumb/wNumb.min.js"></script>

    <!-- gridjs js -->
    <script src="<?= BASE_PATH ?>public/libs/gridjs/gridjs.umd.js"></script>
    <script src="../../../../unpkg.com/gridjs%405.1.0/plugins/selection/dist/selection.umd.js"></script>
    <!-- ecommerce product list -->
    <script src="<?= BASE_PATH ?>public/js/pages/ecommerce-product-list.init.js"></script>


</body>


</html>