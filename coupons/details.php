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
                                    <h3 class="mb-0">Detalles del cupón</h3>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="hstack gap-3">
                                        <button class="btn btn-warning fs-15" data-bs-toggle="modal" data-bs-target="#modal-form">
                                            <i data-feather="edit-2" class="icon-xs me-1"></i>
                                            Editar cupón
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-9">
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
                                                    <th scope="row">Código</th>
                                                    <td class="text-muted">DANISEP Código</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tipo de código</th>
                                                    <td class="text-muted">DANISEP Tipo de código</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cantidad de descuento</th>
                                                    <td class="text-muted">DANISEP Cantidad de descuento</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Máximo de usos</th>
                                                    <td class="text-muted">DANISEP Máximo de usos</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Usos</th>
                                                    <td class="text-muted">DANISEP Usos</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Dinero mínimo en compra</th>
                                                    <td class="text-muted">DANISEP Dinero mínimo en compra</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cantidad de productos mínima</th>
                                                    <td class="text-muted">DANISEP Cantidad de productos mínima</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Fecha de inicio</th>
                                                    <td class="text-muted">DANISEP Fecha de inicio</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Fecha de finalización</th>
                                                    <td class="text-muted">DANISEP Fecha de finalización</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Estado</th>
                                                    <td class="text-muted">DANISEP Estado</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Válido sólo en primera compra</th>
                                                    <td class="text-muted">DANISEP Válido 1ra compra</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card bg-secondary">
                                        <div class="card-body p-0">
                                            <div class="py-3 px-3">
                                                <h5 class="text-white-75 text-uppercase fs-13">Órdenes con este cupón</h5>
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
                                </div>
                                <div class="col-12">
                                    <div class="card bg-success">
                                        <div class="card-body p-0">
                                            <div class="py-3 px-3">
                                                <h5 class="text-white-75 text-uppercase fs-13">Total de dinero descontado</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-money-dollar-circle-line display-6 text-white"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h2 class="mb-0"><span class="counter-value text-white" data-target="200">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div><!-- end col -->

                    </div>
                    

                    <!-- Órdenes -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Órdenes con este cupón</h6>
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


            <!-- MODAL Editar cupón -->
            <div id="modal-form" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Agregar cupón</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        <label>Nombre</label>
                                        <input type="text" placeholder="Nombre" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Código</label>
                                        <input type="text" placeholder="Nombre" class="form-control">
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label>Descuento de</label>
                                        <select class="form-select" aria-label="Floating label select example">
                                            <option value="1">Porcentaje</option>
                                            <option value="2">Cantidad fija</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- A este no sé si estaría bien dependiendo del select de arriba cambiarle el texto para que diga "Cantidad" o "Porcentaje" -->
                                        <label>Cantidad</label> 
                                        <!-- Igual con el Placeholder -->
                                        <input type="number" placeholder="Cantidad" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Máximo de usos</label>
                                        <input type="number" placeholder="Máximo de usos" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Dinero mínimo en la compra</label>
                                        <input type="number" placeholder="Mínimo de compra" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mínimo de productos en la compra</label>
                                        <input type="number" placeholder="Mínimo de productos" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Fecha de inicio</label>
                                        <input type="date" placeholder="Fecha de inicio" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Fecha de finalización</label>
                                        <input type="date" placeholder="Fecha de finalización" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" id="chkValidoPrimeraCompra" class="form-check-input">
                                        <label for="chkValidoPrimeraCompra" class="form-check-label ms-1">Válido sólo en primera compra</label>
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
            <!-- END MODAL Editar cupón -->


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