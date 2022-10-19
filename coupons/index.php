<?php 
    $base_ruta = "../"; //Esta madre se la concateno en los include para no tener que cambiarlo manualmente y nomas cambiarlo una vez jejeje
	include $base_ruta."app/config.php";
?> 
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

	<?php include $base_ruta."layouts/head.template.php"; ?>
    <title>Examen - Cupones</title>
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

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <h3 class="mb-0">Cupones</h3>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button data-bs-target="#modal-form" data-bs-toggle="modal" class="btn-success btn fs-15">
                                                <i class="ri-add-line align-bottom me-1"></i> 
                                                Agregar cupón
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table-hover align-middle table mb-0">
                                            <thead>
                                                <tr>
                                                    <!-- <th scope="col">Avatar</th> -->
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Código</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Porcentaje de descuento</th>
                                                    <th scope="col">Cantidad de descuento</th>
                                                    <th scope="col">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>DANISEP Nombre</td>
                                                    <td>DANISEP Código</td>
                                                    <td>DANISEP Tipo</td>
                                                    <td>DANISEP Porcentaje</td>
                                                    <td>DANISEP Cantidad</td>
                                                    <td>
                                                        <!-- Ni la más mínima idea de qué es esto del estado, en el ejemplo nomas es un número -->
                                                        DANISEP Estado
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?=BASE_PATH?>cliente/1">
                                                            <button title="Detalles" class="btn-ghost-info btn-icon btn rounded-circle shadow-none" type="button">
                                                                <i data-feather="info" class="icon-dual-info icon-sm"></i>
                                                            </button>
                                                        </a>
                                                        <button title="Editar cliente" data-bs-target="#modal-form" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button">
                                                            <i data-feather="edit-2" class="icon-dual-warning icon-sm"></i>
                                                        </button>
                                                        <button title="Eliminar cliente" data-bs-target="#modal-eliminar" data-bs-toggle="modal" class="btn-ghost-danger btn-icon btn rounded-circle shadow-none" type="button">
                                                            <i data-feather="trash-2" class="icon-dual-danger icon-sm"></i>
                                                        </button>
                                                    </td>
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

            
            <!-- MODAL Agregar/editar cupón -->
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
                                        <label class="form-check-label" for="chkValidoPrimeraCompra">Válido sólo en primera compra</label>
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


            <!-- MODAL Eliminar cupón -->
            <div id="modal-eliminar" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">¿Estás seguro de que quieres eliminar a este cupón?</h4>
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
            <!-- END MODAL Eliminar cupón -->

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