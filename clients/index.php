<?php 
    $base_ruta = "../"; //Esta madre se la concateno en los include para no tener que cambiarlo manualmente y nomas cambiarlo una vez jejeje
	include $base_ruta."app/config.php";
    include $base_ruta."app/ClientController.php";

    $clients = ClientController::getClients();
    
    if(!isset($_SESSION['id'])){
        header("Location: ".BASE_PATH);
    }
?> 
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

	<?php include $base_ruta."layouts/head.template.php"; ?>
    <title>Examen - Clientes</title>
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

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <h3 class="mb-0">Clientes</h3>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button data-bs-target="#modal-form" data-bs-toggle="modal" class="btn-success btn fs-15">
                                                <i class="ri-add-line align-bottom me-1"></i> 
                                                Agregar cliente
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
                                                    <th scope="col">Correo electrónico</th>
                                                    <th scope="col">Número de teléfono</th>
                                                    <th scope="col">Nivel</th>
                                                    <th scope="col">Órdenes</th>
                                                    <th scope="col">Direcciones</th>
                                                </tr>
                                            </thead>
                                            <?php foreach($clients as $client): ?>
                                                <tbody>
                                                    <tr>
                                                        <!-- <td>
                                                            <img src="<?= BASE_PATH?>public/images/users/avatar-1.jpg" alt="DANISEP Nombre del producto" class="avatar-sm rounded shadow">
                                                            <button title="Editar avatar del usuario" data-bs-target="#modal-form-img" data-bs-toggle="modal" class="btn-ghost-warning btn btn-icon rounded-circle shadow-none" type="button">
                                                                <i data-feather="edit-2" class="icon-dual-warning icon-sm"></i>
                                                            </button>
                                                        </td> -->
                                                        <td><?= $client->name ?? "Sin nombre" ?></td>
                                                        <td><?= $client->email ?? "Sin email" ?></td>
                                                        <td><?= $client->phone_number ?? "Sin telefono" ?></td>
                                                        <td>
                                                            <?= $client->level->name ?? "N/A";
                                                            switch($client->level->name) {
                                                                case "Normal": ?>
                                                                    <span class="badge badge-soft-primary badge-border fs-12"><?= "-".$client->level->percentage_discount."%" ?? "" ?></span>
                                                                    <?php break;
                                                                case "Premium": ?>
                                                                    <span class="badge badge-soft-success badge-border fs-12"><?= "-".$client->level->percentage_discount."%" ?? "" ?></span>
                                                                    <?php break;
                                                                case "VIP": ?>
                                                                    <span class="badge badge-soft-warning badge-border fs-12"><?= "-".$client->level->percentage_discount."%" ?? "" ?></span>
                                                                    <?php break;
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?= count($client->orders); ?>
                                                        </td>
                                                        <td width="20%">
                                                            <!-- Le puse cantidad pero ya sabrás si le quieres poner mejor el texto de cada dirección -->
                                                            <?php $cantAddress = count($client->addresses);
                                                            switch(true) {
                                                                case $cantAddress <= 0: ?>
                                                                    N/A <?php 
                                                                    break;
                                                                case $cantAddress == 1:
                                                                    echo $client->addresses[0]->street_and_use_number;
                                                                    break;
                                                                case $cantAddress == 2:
                                                                    echo $client->addresses[0]->street_and_use_number; ?> Y <?= $cantAddress - 1 ?> dirección más
                                                                    <?php break;
                                                                case $cantAddress > 2:
                                                                    echo $client->addresses[0]->street_and_use_number; ?> Y <?= $cantAddress - 1 ?> direcciones más
                                                                    <?php break;
                                                            } ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="<?=BASE_PATH?>clientes/info/1">
                                                                <button title="Detalles" class="btn-ghost-info btn-icon btn rounded-circle shadow-none" type="button">
                                                                    <i data-feather="info" class="icon-dual-info icon-sm"></i>
                                                                </button>
                                                            </a>
                                                            <button title="Editar cliente" data-bs-target="#modal-form" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button">
                                                                <i data-feather="edit-2" class="icon-dual-warning icon-sm"></i>
                                                            </button>
                                                            <button title="Editar contraseña del cliente" data-bs-target="#modal-form-contrasenia" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button">
                                                                <i class="ri-key-line icon-dual-warning fs-20"></i>
                                                            </button>
                                                            <button title="Eliminar cliente" data-bs-target="#modal-eliminar" data-bs-toggle="modal" class="btn-ghost-danger btn-icon btn rounded-circle shadow-none" type="button">
                                                                <i data-feather="trash-2" class="icon-dual-danger icon-sm"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php endforeach ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->

            
            <!-- MODAL Agregar/editar cliente -->
            <div id="modal-form" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Agregar cliente</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form" action="<?=BASE_PATH?>client-c">
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
                                    <!-- Esconder ambas comtraseñas aquí cuando esté en modo de editar, el editar contraseña es un modal aparte -->
                                    <div class="col-lg-6">
                                        <label class="form-label">Contraseña</label>
                                        <div class="form-icon">
                                            <input type="password" placeholder="Contraseña" class="form-control-icon form-control">
                                            <i class="ri-key-line"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Confirmar contraseña</label>
                                        <div class="form-icon">
                                            <input type="password" placeholder="Confirmar contraseña" class="form-control-icon form-control">
                                            <i class="ri-key-fill"></i>
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

                                        <input id="hidden_input" type="hidden" name="action" value="create">
                                        <input id="id" type="hidden" name="id">
                                        <input type="hidden" name="global_token" value="<?=$_SESSION['global_token']?>">
                                        <!-- Campo agregado para que evitar errores en back -->
                                        <input id="client_id" type="hidden" name="client" value="0">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Editar cliente -->


            <!-- MODAL Editar contraseña del usuario -->
            <div id="modal-form-contrasenia" class="modal modal-sm fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar contraseña del cliente</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form" action="<?=BASE_PATH?>client-c">
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


            <!-- MODAL Eliminar cliente -->
            <div id="modal-eliminar" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">¿Estás seguro de que quieres eliminar a este cliente?</h4>
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
            <!-- END MODAL Eliminar cliente -->

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