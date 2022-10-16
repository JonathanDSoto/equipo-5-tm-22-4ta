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
    <title>Examen - Usuarios</title>
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
                                            <h3 class="mb-0">Usuarios</h3>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button data-bs-target="#modal-form" data-bs-toggle="modal" class="btn-success btn fs-15">
                                                <i class="ri-add-line align-bottom me-1"></i> 
                                                Agregar usuario
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table-hover align-middle table mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Avatar</th>
                                                    <th scope="col">Nombre(s)</th>
                                                    <th scope="col">Apellidos</th>
                                                    <th scope="col">Rol</th>
                                                    <th scope="col">Correo electrónico</th>
                                                    <th scope="col">Número de teléfono</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="<?= BASE_PATH?>public/images/users/avatar-1.jpg" alt="DANISEP Nombre del producto" class="avatar-sm rounded shadow">
                                                        <button title="Editar avatar del usuario" data-bs-target="#modal-form-img-usuario" data-bs-toggle="modal" class="btn-ghost-warning btn btn-icon rounded-circle shadow-none" type="button">
                                                            <i data-feather="edit-2" class="icon-dual-warning icon-sm"></i>
                                                        </button>
                                                    </td>
                                                    <td>DANISEP Nombre(s)</td>
                                                    <td>DANISEP Apellidos</td>
                                                    <td>
                                                        <!-- <span class="badge badge-soft-primary fs-12">DANISEP Rol</span> -->
                                                        DANISEP Rol
                                                    </td>
                                                    <td>DANISEP Correo</td>
                                                    <td>DANISEP Teléfono</td>
                                                    <td class="text-center">
                                                        <a href="<?=BASE_PATH?>producto/DANISEP">
                                                            <button title="Detalles" class="btn-ghost-info btn-icon btn rounded-circle shadow-none" type="button">
                                                                <i data-feather="info" class="icon-dual-info icon-sm"></i>
                                                            </button>
                                                        </a>
                                                        <button title="Editar usuario" data-bs-target="#modal-form" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button">
                                                            <i data-feather="edit-2" class="icon-dual-warning icon-sm"></i>
                                                        </button>
                                                        <button title="Eliminar usuario" data-bs-target="#modal-eliminar" data-bs-toggle="modal" class="btn-ghost-danger btn-icon btn rounded-circle shadow-none" type="button">
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

            
            <!-- MODAL Agregar/editar usuario -->
            <div id="modal-form" class="modal modal-lg fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Agregar usuario</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-6">
                                        <label>Nombre(s)</label>
                                        <input type="text" placeholder="Nombre(s)" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Apellidos</label>
                                        <input type="text" placeholder="Apellidos" class="form-control">
                                    </div>
                                    <!-- Input with Icon -->
                                    <div class="col-lg-6">
                                        <label class="form-label">Correo electrónico</label>
                                        <div class="form-icon">
                                            <input type="email" placeholder="example@gmail.com" class="form-control-icon form-control">
                                            <i class="ri-mail-line"></i>
                                        </div>
                                    </div>
                                    <!-- Input with Icon -->
                                    <div class="col-lg-6">
                                        <label class="form-label">Contraseña</label>
                                        <div class="form-icon">
                                            <input type="password" placeholder="Contraseña" class="form-control-icon form-control">
                                            <i class="ri-key-line"></i>
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

                                    <!-- Aquí habría que hacer validación de que si está en modo de editar, 
                                    no deje moverle a la imagen, a lo mejor nomas con ponerlo en disabled o esconderlo o como vean, 
                                    a menos que quieran hacer otro modal idéntico pero sin ese campo-->
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
            <!-- END MODAL Agregar/editar usuario -->


            <!-- MODAL Editar avatar del usuario -->
            <div id="modal-form-img-usuario" class="modal modal-lg fade" tabindex="-1" aria-hidden="true" style="display: none;">
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


            <!-- MODAL Eliminar usuario -->
            <div id="modal-eliminar" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">¿Estás seguro de que quieres eliminar a este usuario?</h4>
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
            <!-- END MODAL Eliminar usuario -->

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