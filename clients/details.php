<?php 
    $base_ruta = "../"; //Esta madre se la concateno en los include para no tener que cambiarlo manualmente y nomas cambiarlo una vez jejeje
	include $base_ruta."app/config.php";
?> 
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

	<?php include $base_ruta."layouts/head.template.php"; ?>
    <title>Examen - Detalle Cliente</title>
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
                    <div class="alert alert-success alert-border-left alert-dismissible fade shadow show" role="alert">
                        <i class="ri-check-double-line me-3 align-middle"></i> <strong>¡Éxito!</strong> - La acción se realizó correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <!-- Danger Alert -->
                    <div class="alert alert-danger alert-border-left alert-dismissible fade shadow show" role="alert">
                        <i class="ri-error-warning-line me-3 align-middle"></i> <strong>¡Error!</strong> - Algo salió mal, la acción no se pudo realizar correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <h3 class="mb-0">Detalles del cliente</h3>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="hstack gap-3">
                                        <button class="btn btn-warning fs-15" data-bs-toggle="modal" data-bs-target="#modal-form">
                                            <i data-feather="edit-2" class="icon-xs me-1"></i>
                                            Editar cliente
                                        </button>
                                        <button class="btn btn-warning fs-15" data-bs-toggle="modal" data-bs-target="#modal-form-contrasenia">
                                            <i data-feather="key" class="icon-xs me-1"></i>
                                            Editar contraseña
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Nombre</th>
                                                    <td class="text-muted">DANISEP Nombre</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Nivel</th>
                                                    <td class="text-muted">
                                                        DANISEP Nivel
                                                        <span class="badge badge-soft-success badge-border fs-12 ms-1">-10%</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Correo electrónico</th>
                                                    <td class="text-muted">DANISEP@gmail.com</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Número de teléfono</th>
                                                    <td class="text-muted">612-DANISEP</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Direcciones
                                                        <button title="Agregar dirección" data-bs-target="#modal-form-direccion" data-bs-toggle="modal" class="btn-ghost-success btn-icon btn rounded-circle shadow-none ms-2" type="button">
                                                            <i data-feather="plus" class="icon-sm icon-dual-success"></i>
                                                        </button>
                                                    </th>
                                                    <td class="align-middle text-muted">
                                                        <ul class="list-group">
                                                            <li class="list-group-item text-muted pt-0 pb-0">
                                                                Calle DANISEP #129 La Paz, Baja California Sur 23000
                                                                <button title="Editar dirección" data-bs-target="#modal-form-direccion" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none ms-2" type="button">
                                                                    <i data-feather="edit-2" class="icon-xs icon-dual-warning"></i>
                                                                </button>
                                                                <button title="Eliminar dirección" data-bs-target="#modal-eliminar-direccion" data-bs-toggle="modal" class="btn-ghost-danger btn-icon btn rounded-circle shadow-none" type="button">
                                                                    <i data-feather="trash-2" class="icon-xs icon-dual-danger"></i>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                        <!-- No hay direcciones registradas. -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Actualizado en</th>
                                                    <td class="text-muted">DANISEP 01/01/01</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <!-- Órdenes -->
                    <div class="row">
                        <div class="col-2">
                            <div class="card bg-success">
                                <div class="card-body p-0">
                                    <div class="py-3 px-3">
                                        <h5 class="text-white-75 text-uppercase fs-13">Total de órdenes</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-shopping-bag-line display-6 text-white"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value text-white" data-target="200">0</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-10">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Órdenes del producto</h6>
                                </div>
                                <!-- Tabla de órdenes -->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0 align-middle">
                                            <tbody>
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Productos</th>
                                                    <th>Total de la orden</th>
                                                    <th>Estado de pago</th>
                                                    <th>Tipo de pago</th>
                                                    <th>Cupón</th>
                                                    <th>Dirección</th>
                                                    <th>Estado de orden</th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <td>Folio</td>
                                                    <td>Cantidad Productos</td>
                                                    <td>Total de la orden</td>
                                                    <td>Estado de pago</td>
                                                    <td>Tipo de pago</td>
                                                    <td>Cupón</td>
                                                    <td>Dirección</td>
                                                    <td>Estado de orden</td>
                                                    <td>
                                                        <a href="DANISEP">
                                                            <a href="DANISEP" class="link-info">
                                                                Detalles <i class="ri-arrow-right-line me-1"></i>
                                                            </a>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END Tabla de órdenes -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->


            <!-- MODAL Editar cliente -->
            <div id="modal-form" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar cliente</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-12">
                                        <label>Nombre</label>
                                        <input type="text" placeholder="Nombre" class="form-control">
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
                                        <label>Nivel</label>
                                        <select class="form-select" aria-label="Floating label select example">
                                            <option value="1">Normal</option>
                                            <option value="2">Premium</option>
                                            <option value="3">VIP</option>
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
            <!-- END MODAL Editar cliente -->


            <!-- MODAL Editar contraseña del cliente -->
            <div id="modal-form-contrasenia" class="modal modal-sm fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar contraseña del cliente</h4>
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
            <!-- END MODAL Editar contraseña del cliente -->


            <!-- MODAL Agregar/editar dirección -->
            <div id="modal-form-direccion" class="modal modal-lg fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Agregar dirección</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-6">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" placeholder="Nombre" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Apellido</label>
                                        <input type="text" placeholder="Apellido" class="form-control">
                                    </div>
                                    <div class="col-lg-9">
                                        <label class="form-label">Calle y número</label>
                                        <input type="text" placeholder="Calle y número" class="form-control">
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="form-label">Código postal</label>
                                        <input type="number" placeholder="Código postal" class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label">Ciudad</label>
                                        <input type="text" placeholder="Ciudad" class="form-control">
                                    </div>
                                    <div class="col-lg-5">
                                        <label class="form-label">Provincia o estado</label>
                                        <input type="text" placeholder="Provincia o estado" class="form-control">
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="form-label">Número de teléfono</label>
                                        <input type="number" placeholder="Número de teléfono" class="form-control">
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
            <!-- END MODAL Agregar/editar dirección -->

            <!-- MODAL Eliminar dirección -->
            <div id="modal-eliminar-direccion" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">¿Estás seguro de que quieres eliminar esta dirección?</h4>
                                <p class="text-muted mb-4">Esta acción es permanente y no podrá ser revertida.</p>
                                <div class="hstack gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-danger">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Eliminar dirección -->

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
 
    <!-- Widget init -->
    <script src="<?= BASE_PATH ?>public/js/pages/widgets.init.js"></script>

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