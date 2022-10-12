<?php 
    $base_ruta = "../../";
	include $base_ruta."app/ProductsController.php";
	include $base_ruta."app/BrandController.php";

	$productController = new ProductsController();

	$brandController = new BrandController();

	// $products = $productController->getProducts();
	// $brands = $brandController->getBrands();

	#echo json_encode($_SESSION);
?> 
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
	<?php include $base_ruta."layouts/head.template.php"; ?>
    <title>Examen - Etiquetas</title>

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
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <h3 class="mb-0">Etiquetas</h3>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-success fs-15" data-bs-toggle="modal" data-bs-target="#modal-form">
                                        <i class="ri-add-line align-bottom me-1"></i> 
                                        Agregar etiqueta
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- INICIO CARD DE LA ETIQUETA -->
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 me-3">
                                            <h6 class="card-title mb-0">
                                                DANISEP Nombre de la etiqueta
                                            </h6>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="list-inline card-toolbar-menu d-flex align-items-center mb-0">
                                                <li class="list-inline-item">
                                                    <button data-bs-toggle="modal" data-bs-target="#modal-form" class="btn btn-icon btn-topbar btn-ghost-warning rounded-circle shadow-none" type="button">
                                                        <i data-feather="edit-2" class="icon-xs icon-dual-warning"></i>
                                                    </button>
                                                    <button data-bs-toggle="modal" data-bs-target="#modal-eliminar" class="btn btn-icon btn-topbar btn-ghost-danger rounded-circle shadow-none" type="button">
                                                        <i data-feather="trash-2" class="icon-xs icon-dual-danger"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text" style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;text-overflow: ellipsis;">
                                        DANISEP Descripción de etiqueta
                                    </p>
                                    <p class="card-text text-secondary"><small>
                                        DANISEP 4 productos
                                    </small></p>
                                </div>
                            </div>
                        </div>
                        <!-- FIN CARD DE LA ETIQUETA -->
        
        
                    </div>
                </div>
            </div>
            <!-- End Page-content -->


            <div id="modal-form" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Agregar etiqueta</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" placeholder="Escribe aquí el nombre">
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" placeholder="Escribe aquí el slug">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea type="text" class="form-control" id="description" placeholder="Escribe aquí la descripción"></textarea>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div id="modal-eliminar" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">¿Estás seguro de que quieres eliminar esta etiqueta?</h4>
                                <p class="text-muted mb-4">Esta acción es permanente y no podrá ser revertida.</p>
                                <div class="hstack gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-danger">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            

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