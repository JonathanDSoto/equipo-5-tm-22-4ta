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
    <title>Examen - Detalle producto</title>
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
                        <div class="col-lg-9 col-sm-12">
                            <div class="card">
                                <!-- DATOS DE ARRIBA -->
                                <div class="card-body border-bottom">
                                    <div class="row gx-lg-5">

                                        <!-- IMAGEN PRODUCTO -->
                                        <div class="col-xl-4 col-md-4 mx-auto">
                                            <div class="product-img-slider sticky-side-div">
                                                <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                                    <div class="swiper-slide">
                                                        <img src="<?=BASE_PATH?>public/images/products/img-8.png" alt="" class="img-fluid d-block" />
                                                    </div>
                                                </div>
                                                <!-- end swiper thumbnail slide -->
                                            </div>
                                        </div>
                                        <!-- FIN IMAGEN PRODUCTO -->

                                        <div class="col-xl-8 col-md-8">
                                            <div class="mt-xl-0 mt-md-0 mt-5">

                                                <!-- Parte superior con nombre, marca, slug, botones -->
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h4>DANISEP Nombre producto</h4>
                                                        <div class="hstack gap-3 flex-wrap">
                                                            <div class="text-muted">Marca: <span class="text-primary fw-medium">DANISEP Marca</span></div>
                                                            <div class="vr"></div>
                                                            <div class="text-muted">Slug: <span class="text-body fw-medium">DANISEP Slug</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div>
                                                            <button data-bs-toggle="modal" data-bs-target="#modal-form-producto" class="btn btn-icon btn-topbar btn-ghost-warning rounded-circle shadow-none" type="button">
                                                                <i data-feather="edit-2" class="icon-lg icon-dual-warning"></i>
                                                            </button>
                                                            <button data-bs-toggle="modal" data-bs-target="#modal-eliminar-producto" class="btn btn-icon btn-topbar btn-ghost-danger rounded-circle shadow-none" type="button">
                                                                <i data-feather="trash-2" class="icon-lg icon-dual-danger"></i>
                                                            </button>
                                                            <!-- <a href="apps-ecommerce-add-product.html" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ri-pencil-fill align-bottom"></i></a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Parte superior con nombre, marca, slug, botones -->


                                                <!-- Descripción y características -->
                                                <div class="row mt-4">
                                                    <div class="text-muted">
                                                        <h5 class="fs-14">Descripción del producto</h5>
                                                        <p>DANISEP Descripción del producto</p>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="text-muted">
                                                        <h5 class="fs-14">Características del producto</h5>
                                                        <p>DANISEP Características del producto</p>
                                                    </div>
                                                </div>
                                                <!-- END Descripción y características -->


                                                <!-- Categorías y etiquetas con badges -->
                                                <div class="row mt-4">
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="text-muted">
                                                            <h5 class="fs-14">Categorías</h5>
                                                            <span class="badge badge-soft-primary fs-12 mb-1">DANISEP Categoría</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="text-muted">
                                                            <h5 class="fs-14">Etiquetas</h5>
                                                            <span class="badge badge-soft-secondary fs-12 mb-1">DANISEP Etiqueta</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Categorías y etiquetas con badges -->

                                                

                                                <!-- Lista presentaciones -->
                                                <!-- <div class="mt-4">
                                                    <h4 class="fs-14">Presentaciones</h4>
                                                    <div class="list-group">
                                                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">Presentación activa</button>
                                                        <button type="button" class="list-group-item list-group-item-action">Otra presentación</button>
                                                        <button type="button" class="list-group-item list-group-item-action">Otra presentación</button>
                                                        <button type="button" class="list-group-item list-group-item-action" disabled>Presentación sin stock</button>
                                                    </div>
                                                </div> -->
                                                <!-- END Lista presentaciones -->

                                                
                                                
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- END DATOS DE ARRIBA -->

                                <!-- Tabla de presentaciones -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 align-middle">
                                            <tbody>
                                                <tr>
                                                    <th></th>
                                                    <td class="pt-0"><img src="<?=BASE_PATH?>public/images/users/avatar-8.jpg" alt="" class="rounded avatar-xl shadow"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-xl-3 col-2">
                                                        <button data-bs-target="#modal-form-presentacion" data-bs-toggle="modal" class="btn btn-ghost-success shadow-none">
                                                            <i class="ri-add-line me-1"></i>Agregar presentación
                                                        </button>
                                                    </th>
                                                    <th>Presentación 1</th>
                                                </tr>
                                                <tr>
                                                    <th>Precio</th>
                                                    <th>$500</th>
                                                </tr>
                                                <tr>
                                                    <th>En stock</th>
                                                    <td>15</td>
                                                </tr>
                                                <tr>
                                                    <th>Stock mínimo</th>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <th>Stock máximo</th>
                                                    <td>20</td>
                                                </tr>
                                                <tr>
                                                    <th>Peso</th>
                                                    <td>150 gramos</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <button data-bs-target="#modal-form-presentacion" data-bs-toggle="modal" class="btn btn-icon btn-topbar btn-ghost-warning rounded-circle shadow-none" type="button">
                                                            <i data-feather="edit-2" class="icon-sm icon-dual-warning"></i>
                                                        </button>
                                                        <button data-bs-target="#modal-eliminar-presentacion" data-bs-toggle="modal" class="btn btn-icon btn-topbar btn-ghost-danger rounded-circle shadow-none" type="button">
                                                            <i data-feather="trash-2" class="icon-sm icon-dual-danger"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                                <!-- END Tabla de presentaciones -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <!-- Formulario derecha comprar -->
                        <div class="col-lg-3 col-sm-12">
                            <div class="card sticky-side-div">
                                <div class="card-body">
                                    <form action="" class="align-middle">
                                        <div class="mb-3">
                                            <label class="form-label">Presentación</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">DANISEP Presentación 1</option>
                                                <option value="2">DANISEP Presentación 2</option>
                                                <option value="3" disabled>DANISEP Presentación sin stock?</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Cantidad</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                        <!-- <div class="mb-3">
                                            <label class="form-label">Cupón</label>
                                            <div class="form-icon">
                                                <input type="text" class="form-control form-control-icon" placeholder="Escribe aquí un cupón">
                                                <i class="mdi mdi-ticket-outline"></i>
                                            </div>
                                        </div> -->
                                        <div class="mb-3 text-center">
                                            <h5 class="form-label">Subtotal: $4500</h5>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">
                                                Agregar al carrito
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Formulario derecha comprar -->

                    </div>
                    <!-- end row -->
                    
                </div>
            </div>
            <!-- End Page-content -->


            <!-- MODAL Agregar/editar producto -->
            <div id="modal-form-producto" class="modal modal-lg fade" tabindex="-1" aria-hidden="true" style="display: none;">
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
                    </div>
                </div>
            </div>
            <!-- END MODAL Agregar/editar producto -->


            <!-- MODAL Eliminar producto -->
            <div id="modal-eliminar-producto" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">¿Estás seguro de que quieres eliminar este producto?</h4>
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
            <!-- END MODAL Eliminar producto -->


             <!-- MODAL Agregar/editar presentacion -->
            <div id="modal-form-presentacion" class="modal modal-lg fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Agregar presentacion</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-8">
                                        <label>Nombre/descripción</label>
                                        <input type="text" class="form-control" placeholder="Escribe aquí el nombre o descripción">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Código</label>
                                        <input type="text" class="form-control" placeholder="Escribe aquí el código">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Imagen</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Peso (en gramos)</label>
                                        <input type="text" class="form-control" placeholder="Escribe aquí el peso en gramos">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="pres-status">Estado</label>
                                        <select class="form-select" id="pres-status" aria-label="Floating label select example">
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Stock</label>
                                        <input type="text" class="form-control" placeholder="Cantidad en stock">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Stock mínimo</label>
                                        <input type="text" class="form-control" placeholder="Cantidad de stock mínima">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Stock máximo</label>
                                        <input type="text" class="form-control" placeholder="Cantidad de stock máxima">
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
            <!-- END MODAL Agregar/editar presentacion -->


            <!-- MODAL Eliminar presentacion -->
            <div id="modal-eliminar-presentacion" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">¿Estás seguro de que quieres eliminar esta presentación?</h4>
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
            <!-- END MODAL Eliminar presentacion -->

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
    <!-- init js -->
    <script src="<?= BASE_PATH ?>public/js/pages/form-advanced.init.js"></script>
    <!-- input spin init -->
    <script src="<?= BASE_PATH ?>public/js/pages/form-input-spin.init.js"></script>


</body>


</html>