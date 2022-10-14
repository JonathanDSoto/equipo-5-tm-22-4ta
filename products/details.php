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
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
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
                                                            <a href="apps-ecommerce-add-product.html" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ri-pencil-fill align-bottom"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Descripción y características 6 y 6 -->
                                                <!-- <div class="row mt-4">
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="text-muted">
                                                            <h5 class="fs-14">Descripción del producto</h5>
                                                            <p>DANISEP Descripción del producto</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="text-muted">
                                                            <h5 class="fs-14">Características del producto</h5>
                                                            <p>DANISEP Características del producto</p>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- END Descripción y características 6 y 6 -->

                                                <!-- Descripción y características 12 y 12 -->
                                                <div class="row mt-4">
                                                    <div class="text-muted">
                                                        <h5 class="fs-14">Descripción del producto</h5>
                                                        <p>DANISEP Descripción del producto</p>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="text-muted">
                                                        <h5 class="fs-14">Características del producto</h5>
                                                        <p>DANISEP Características del producto</p>
                                                    </div>
                                                </div>
                                                <!-- END Descripción y características 12 y 12 -->


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


                                                <div class="product-content mt-5">
                                                    <h5 class="fs-14 mb-3">Presentaciones</h5>
                                                    <nav>
                                                        <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="nav-speci-tab" data-bs-toggle="tab" href="#nav-speci" role="tab" aria-controls="nav-speci" aria-selected="true">
                                                                    Presentación
                                                                    <span class="badge badge-soft-success fs-12 mb-1">Disponible</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false">
                                                                    Otra presentación
                                                                    <span class="badge badge-soft-danger fs-12 mb-1">Agotado</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                    <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                                        <div class="tab-pane fade show active" id="nav-speci" role="tabpanel" aria-labelledby="nav-speci-tab">
                                                            <!-- <div class="row">
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="p-2 border border-dashed rounded">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="avatar-sm me-2">
                                                                                <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                                    <i class="ri-money-dollar-circle-fill"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex-grow-1">
                                                                                <p class="text-muted mb-1">Precio</p>
                                                                                <h5 class="mb-0">$120.40</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="p-2 border border-dashed rounded">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="avatar-sm me-2">
                                                                                <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                                    <i class="ri-stack-fill"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex-grow-1">
                                                                                <p class="text-muted mb-1">Disponibles</p>
                                                                                <h5 class="mb-0">1,230</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="p-2 border border-dashed rounded">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="avatar-sm me-2">
                                                                                <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                                    <i class="ri-file-copy-2-fill"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex-grow-1">
                                                                                <p class="text-muted mb-1">Peso :</p>
                                                                                <h5 class="mb-0">2,234</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="p-2 border border-dashed rounded">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="avatar-sm me-2">
                                                                                <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                                    <i class="ri-inbox-archive-fill"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex-grow-1">
                                                                                <p class="text-muted mb-1">Total Revenue :</p>
                                                                                <h5 class="mb-0">$60,645</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <!-- Responsive Images -->
                                                                    <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                                                        <div class="swiper-slide">
                                                                            <img src="<?= BASE_PATH ?>public/images/products/img-1.png" class="img-fluid rounded" alt="Responsive image">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <!-- <img src="<?= BASE_PATH ?>public/images/products/img-1.png" alt="" class="rounded avatar-xl shadow"> -->
                                                                </div>
                                                                <div class="col-8">
                                                                    <div class="table-responsive mb-3">
                                                                        <table class="table mb-0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row" style="width: 150px;">Precio</th>
                                                                                    <th>DANISEP $1500</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Stock</th>
                                                                                    <td>DANISEP 1200 disponibles</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Peso</th>
                                                                                    <td>DANISEP 150 gramos</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <form action="" class="align-middle mb-3">
                                                                        <div class="input-step align-middle">
                                                                            <button type="button" class="minus">-</button>
                                                                            <input type="number" class="product-quantity" value="1" min="0" max="100" readonly>
                                                                            <button type="button" class="plus">+</button>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Agregar al carrito????</button>
                                                                    </form>
                                                                    <h5>Subtotal: $3000</h5>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                                                            <div>
                                                                <h5 class="font-size-16 mb-3">Tommy Hilfiger Sweatshirt for Men (Pink)</h5>
                                                                <p>Tommy Hilfiger men striped pink sweatshirt. Crafted with cotton. Material composition is 100% organic cotton. This is one of the world’s leading designer lifestyle brands and is internationally recognized for celebrating the essence of classic American cool style, featuring preppy with a twist designs.</p>
                                                                <div>
                                                                    <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> Machine Wash</p>
                                                                    <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> Fit Type: Regular</p>
                                                                    <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> 100% Cotton</p>
                                                                    <p class="mb-0"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> Long sleeve</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- product-content -->

                                                <!-- <div class="mt-4">
                                                    <h4 class="fs-14">Presentaciones</h4>
                                                    <div class="list-group list-group-horizontal-md">
                                                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">Presentación activa</button>
                                                        <button type="button" class="list-group-item list-group-item-action">Otra presentación</button>
                                                        <button type="button" class="list-group-item list-group-item-action">Otra presentación</button>
                                                        <button type="button" class="list-group-item list-group-item-action" disabled>Presentación sin stock</button>
                                                    </div>
                                                </div> -->
                                                
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                </div>
            </div>
            <!-- End Page-content -->



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