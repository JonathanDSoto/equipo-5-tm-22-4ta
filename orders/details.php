<?php 
    $base_ruta = "../"; //Esta madre se la concateno en los include para no tener que cambiarlo manualmente y nomas cambiarlo una vez jejeje
	include $base_ruta."app/config.php";
?> 
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

	<?php include $base_ruta."layouts/head.template.php"; ?>
    <title>Examen - Detalle Orden</title>
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
                                    <h3 class="mb-0">Detalles de orden</h3>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="hstack gap-3">
                                        <!-- Pues aquí se me ocurría ponerles diferentes colores, no sé cómo lo vean pero pensé en -->
                                        <!-- Pendiente de pago: Light     -->
                                        <!-- Pagada: Primary              -->
                                        <!-- Enviada: Secondary           -->
                                        <!-- Abandonada: Dark             -->
                                        <!-- Pendiente de enviar: Warning -->
                                        <!-- Cancelada: Danger            -->
                                        <!-- Justo aquí             ||    -->
                                        <!--                        ||    -->
                                        <!--                      --  --  -->
                                        <!--                      \\\///  -->
                                        <span class="badge text-bg-light fs-18">Estado de la orden</span>
                                        <button class="btn btn-warning fs-15" data-bs-toggle="modal" data-bs-target="#modal-edit-status">
                                            <i data-feather="edit-2" class="icon-xs me-1"></i>
                                            Editar estado de la orden
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Órdenes -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Productos en la orden</h6>
                                </div>
                                <!-- Tabla de órdenes -->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0 align-middle">
                                            <tbody>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Imagen</th>
                                                    <th>Presentación</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <td>Producto</td>
                                                    <td>
                                                        <img src="<?= BASE_PATH?>public/images/products/img-1.png" alt="DANISEP Nombre de presentación" class="rounded avatar-sm shadow">
                                                    </td>
                                                    <td>Presentación</td>
                                                    <td>Precio</td>
                                                    <td>Cantidad</td>
                                                    <td>
                                                        <a href="DANISEP">
                                                            <a href="<?=BASE_PATH?>producto/info/DANISEP" class="link-info">
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
                        <!-- <div class="col-lg-3 col-sm-12">
                            <div class="card sticky-side-div">
                                <div class="card-body">
                                    <form action="DANISEP" class="align-middle">
                                        <div class="mb-3 text-center">
                                            <h5 class="form-label">Subtotal: $4500</h5>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Cupón</label>
                                            <div class="form-icon">
                                                <input type="text" class="form-control form-control-icon" placeholder="Escribe aquí un cupón">
                                                <i class="mdi mdi-ticket-outline"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3 text-center">
                                            <h5 class="form-label">Total: $4500</h5>
                                        </div>
                                        <div class="text-center">
                                            <button type="sumbit" class="btn btn-primary btn-label waves-effect waves-light">
                                                <i class="ri-shopping-cart-line label-icon align-middle fs-16 me-2"></i> Agregar al carrito
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr class="border-top">
                                                    <th scope="row">Folio</th>
                                                    <td class="text-muted">DANISEP Folio</td>
                                                </tr>
                                                <!-- <tr>
                                                    <th scope="row">Producto - Presentación - Cantidad</th>
                                                    <td class="text-muted">DANISEP Producto - Presentación - Cantidad</td>
                                                </tr> -->
                                                <tr class="border-top">
                                                    <th scope="row">Nombre del cliente</th>
                                                    <td class="text-muted">DANISEP Nombre del cliente</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Correo electrónico</th>
                                                    <td class="text-muted">DANISEP Correo electrónico</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Número de teléfono</th>
                                                    <td class="text-muted">DANISEP Número de teléfono</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Nivel</th>
                                                    <td class="text-muted">DANISEP Nivel</td>
                                                </tr>

                                                <tr class="border-top">
                                                    <th scope="row">Dirección</th>
                                                    <!-- O si no pues en filas separadas no se -->
                                                    <td class="text-muted">DANISEP Dirección + codigo postal + ciudad + provincia</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">A nombre de</th>
                                                    <td class="text-muted">DANISEP nombre + apellidos</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Número de teléfono (dirección)</th>
                                                    <td class="text-muted">DANISEP Número de teléfono (dirección)</td>
                                                </tr>
                                                <tr class="border-top">
                                                    <th scope="row">Total de la orden</th>
                                                    <td class="text-muted">DANISEP Total de la orden</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cupón utilizado</th>
                                                    <td class="text-muted">DANISEP Cupón utilizado</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Estado de pago</th>
                                                    <td class="text-muted">DANISEP Estado de pago</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tipo de pago</th>
                                                    <td class="text-muted">DANISEP Tipo de pago</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Estado de pago</th>
                                                    <td class="text-muted">DANISEP Estado de pago</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->


            <!-- MODAL Editar estado de orden -->
            <div id="modal-edit-status" class="modal modal-sm fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar estado de orden</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">

                                    <div class="col-md-12">
                                        <label>Estado de la orden</label>
                                        <select class="form-select" aria-label="Floating label select example">
                                            <!-- Se supone que son estas los posibles estados de orden -->
                                            <!-- Sacado del Update Order de la api que ahi vienen segun -->
                                            <option value="1">Pendiente de pago</option>
                                            <option value="2">Pagada</option>
                                            <option value="3">Enviada</option>
                                            <option value="4">Abandonada</option>
                                            <option value="5">Pendiente de enviar</option>
                                            <option value="6">Cancelada</option>
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
            <!-- END MODAL Editar estado de orden -->


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