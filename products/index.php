<?php 
    $base_ruta = "../"; //Esta madre se la concateno en los include para no tener que cambiarlo manualmente y nomas cambiarlo una vez jejeje
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
    <title>Examen - Productos</title>
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
                        <i class=" ri-error-warning-line me-3 align-middle"></i> <strong>¡Error!</strong> - Algo salió mal, la acción no se pudo realizar correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <h3 class="mb-0">Productos</h3>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button class="btn btn-success fs-15" data-bs-toggle="modal" data-bs-target="#modal-form">
                                                <i class="ri-add-line align-bottom me-1"></i> 
                                                Agregar producto
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <!-- Hoverable Rows -->
                                        <table class="table table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Imagen</th>
                                                    <th scope="col">Producto</th>
                                                    <th scope="col">Marca</th>
                                                    <th scope="col">Presentaciones</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Categorías</th>
                                                    <th scope="col">Etiquetas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="<?= BASE_PATH?>public/images/products/img-1.png" alt="DANISEP Nombre del producto" class="rounded avatar-sm shadow">
                                                    </td>
                                                    <td>
                                                        DANISEP Nombre
                                                    </td>
                                                    <td>
                                                        DANISEP Marca
                                                    </td>
                                                    <td>
                                                        DANISEP Cant
                                                    </td>
                                                    <td>
                                                        DANISEP Descripción
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-primary fs-12">DANISEP Categoría</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-secondary fs-12">DANISEP Etiqueta</span>
                                                    </td>
                                                    <td><a href="DANISEP" class="link-success">Detalles <i class="ri-arrow-right-line align-middle"></i></a></td>
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

            <div id="modal-form" class="modal modal-lg fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Agregar producto</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-6">
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control" id="name" placeholder="Escribe aquí el nombre">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="slug">Slug</label>
                                        <input type="text" class="form-control" id="slug" placeholder="Escribe aquí el slug">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="brand">Marca</label>
                                        <select class="form-select" id="brand" aria-label="Floating label select example">
                                            <option value="0">DANISEP Marca</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="image" class="form-label">Imagen</label>
                                        <input class="form-control" type="file" id="image">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="description" class="form-label">Descripción</label>
                                        <textarea type="text" class="form-control" id="description" placeholder="Escribe aquí la descripción"></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="features" class="form-label">Características</label>
                                        <textarea type="text" class="form-control" id="features" placeholder="Escribe aquí las características"></textarea>
                                    </div>

                                    <!-- ACORDEÓN CATEGORÍAS -->
                                    <div class="col-lg-6">
                                        <div class="accordion" id="acordeon-categorias">
                                            <div class="accordion-item shadow">
                                                <h2 class="accordion-header" id="heading-categorias">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-categorias" aria-expanded="false" aria-controls="collapse-categorias">
                                                        Categorías
                                                    </button>
                                                </h2>
                                                <div id="collapse-categorias" class="accordion-collapse collapse" aria-labelledby="heading-categorias" data-bs-parent="#acordeon-categorias">
                                                    <div class="accordion-body">
                                                        <!-- CHECKBOX DE CADA CATEGORÍA -->
                                                        <!-- A cada checkbox se le cambia el id y el name y se le concatena algo para diferenciarlos, muy seguramente el ID de la CATEGORÍA -->
                                                        <!-- A cada label de cada checkbox se le cambia el for para que coincida con el id de su respectivo checkbox -->
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox" id="formCheck1">
                                                            <label class="form-check-label text-dark" for="formCheck1">
                                                                DANISEP Categoría
                                                            </label>
                                                        </div>
                                                        <!-- FIN CHECKBOX DE CADA CATEGORÍA -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN ACORDEÓN CATEGORÍAS -->

                                    <!-- ACORDEÓN ETIQUETAS -->
                                    <div class="col-lg-6">
                                        <div class="accordion" id="acordeon-etiquetas">
                                            <div class="accordion-item shadow">
                                                <h2 class="accordion-header" id="heading-etiquetas">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-etiquetas" aria-expanded="false" aria-controls="collapse-etiquetas">
                                                        Etiquetas
                                                    </button>
                                                </h2>
                                                <div id="collapse-etiquetas" class="accordion-collapse collapse" aria-labelledby="heading-etiquetas" data-bs-parent="#acordeon-etiquetas">
                                                    <div class="accordion-body">
                                                        <!-- CHECKBOX DE CADA ETIQUETA -->
                                                        <!-- A cada checkbox se le cambia el id y el name y se le concatena algo para diferenciarlos, muy seguramente el ID de la ETIQUETA -->
                                                        <!-- A cada label de cada checkbox se le cambia el for para que coincida con el id de su respectivo checkbox -->
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox" id="formCheck1">
                                                            <label class="form-check-label text-dark" for="formCheck1">
                                                                DANISEP Etiqueta
                                                            </label>
                                                        </div>
                                                        <!-- FIN CHECKBOX DE CADA CATEGORÍA -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN ACORDEÓN ETIQUETAS -->
                                    
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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