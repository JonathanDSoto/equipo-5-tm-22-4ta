<?php 
    $base_ruta = "../"; //Esta madre se la concateno en los include para no tener que cambiarlo manualmente y nomas cambiarlo una vez jejeje
	include $base_ruta."app/config.php";
    include $base_ruta."app/ClientController.php";
    include $base_ruta."app/UserController.php";
    include $base_ruta."app/AddressController.php";

    $info = null;
    $url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $id = substr($url, strrpos($url, '/') + 1);

    $clients = ClientController::getClients();
    $addresses = AddressController::getAddressByClient($id);

    foreach ($clients as $client) {
        if($client->id == $id)
        {
            $info = $client;
        }
    }
    
    if(!isset($_SESSION['id'])){
        header("Location: ".BASE_PATH);
    }
    $this_user = null;
    if(isset($_SESSION['id'])){
        $this_user = UserController::getSpecificUser($_SESSION['id']);
    }
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
                    <?php if (isset($_GET['success'])) : ?>
                        <div class="alert alert-success alert-border-left alert-dismissible fade shadow show" role="alert">
                            <i class="ri-check-double-line me-3 align-middle"></i> <strong>????xito!</strong> - La acci??n se realiz?? correctamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Danger Alert -->
                    <?php if (isset($_GET['error'])) : ?>
                        <div class="alert alert-danger alert-border-left alert-dismissible fade shadow show" role="alert">
                            <i class=" ri-error-warning-line me-3 align-middle"></i> <strong>??Error!</strong> - Algo sali?? mal, la acci??n no se pudo realizar correctamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>                   
                    <?php endif; ?>
                    
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
                                            Editar contrase??a
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
                                                    <td class="text-muted"><?= $info->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Nivel</th>
                                                    <td class="text-muted">
                                                    <?= $info->level->name ?? "N/A";
                                                        switch($info->level->name) {
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
                                                </tr>
                                                <tr>
                                                    <th scope="row">Correo electr??nico</th>
                                                    <td class="text-muted"><?= $info->email ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">N??mero de tel??fono</th>
                                                    <td class="text-muted"><?= $info->phone_number ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        Direcciones
                                                        <button title="Agregar direcci??n" data-bs-target="#modal-form-direccion" data-bs-toggle="modal" class="btn-ghost-success btn-icon btn rounded-circle shadow-none ms-2" type="button">
                                                            <i data-feather="plus" class="icon-sm icon-dual-success"></i>
                                                        </button>
                                                    </th>
                                                    <td class="align-right text-muted">
                                                        <ul class="list-group align-right">
                                                            <?php foreach ($info->addresses as $address): ?>
                                                                <li class="list-group-item text-muted pt-0 pb-0">
                                                                    <?= $address->street_and_use_number." ".$address->city.", ".$address->province." ".$address->postal_code ?>
                                                                    <button title="Editar direcci??n" data-bs-target="#modal-form-direccion" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none ms-2" type="button" data-product='<?= json_encode($address) ?>' onclick="editAddress(this)" href="#">
                                                                        <i data-feather="edit-2" class="icon-xs icon-dual-warning"></i>
                                                                    </button>
                                                                    <button title="Eliminar direcci??n" data-bs-target="#modal-eliminar-direccion" data-bs-toggle="modal" class="btn-ghost-danger btn-icon btn rounded-circle shadow-none" type="button">
                                                                        <i data-feather="trash-2" class="icon-xs icon-dual-danger"></i>
                                                                    </button>
                                                                </li>
                                                            <?php endforeach ?>
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
                    

                    <!-- ??rdenes -->
                    <div class="row">
                        <div class="col-2">
                            <div class="card bg-success">
                                <div class="card-body p-0">
                                    <div class="py-3 px-3">
                                        <h5 class="text-white-75 text-uppercase fs-13">Total de ??rdenes</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-shopping-bag-line display-6 text-white"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h2 class="mb-0"><span class="counter-value text-white" data-target=<?= count($info->orders); ?>>0</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-10">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">??rdenes del producto</h6>
                                </div>
                                <!-- Tabla de ??rdenes -->
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
                                                    <th>Cup??n</th>
                                                    <th>Direcci??n</th>
                                                    <th>Estado de orden</th>
                                                </tr>
                                                <?php foreach ($info->orders as $order): ?>
                                                <tr>
                                                    <td><?= $order->folio; ?></td>
                                                    <td><?= count($order->presentations); ?></td>
                                                    <td><?= "$".$order->total; ?></td>
                                                    <td><?php if($order->is_paid) {
                                                        echo "Pagado";
                                                    } else {
                                                        echo "Pendiente";
                                                    } ?></td>
                                                    <td><?php switch($order->payment_type_id) {
                                                        case 1: echo "Efectivo"; 
                                                            break;
                                                        case 2: echo "Tarjeta"; 
                                                            break;
                                                        case 3: echo "Transferencia"; 
                                                            break;
                                                        default: echo "Pendiente";
                                                            break;
                                                    } ?></td>
                                                    <td>
                                                        <?php 
                                                        if(isset($order->coupon->percentage_discount))
                                                            echo $order->coupon->percentage_discount;
                                                        else
                                                            echo "N/A"; ?>
                                                    </td>
                                                    <td>
                                                    <?php 
                                                        if(isset($order->address->street_and_use_number))
                                                            echo $order->address->street_and_use_number;
                                                        else
                                                            echo "N/A"; ?>
                                                    </td>
                                                    <td><?= $order->order_status->name; ?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END Tabla de ??rdenes -->
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
                                        <label class="form-label">Correo electr??nico</label>
                                        <div class="form-icon">
                                            <input type="email" placeholder="example@gmail.com" class="form-control-icon form-control">
                                            <i class="ri-mail-line"></i>
                                        </div>
                                    </div>
                                    
                                    <!-- Input with Icon -->
                                    <div class="col-lg-6">
                                        <label class="form-label">N??mero de tel??fono</label>
                                        <div class="form-icon">
                                            <input type="number" placeholder="N??mero de tel??fono" class="form-control-icon form-control">
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


            <!-- MODAL Editar contrase??a del cliente -->
            <div id="modal-form-contrasenia" class="modal modal-sm fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar contrase??a del cliente</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-12">
                                        <label class="form-label">Contrase??a actual</label>
                                        <div class="form-icon">
                                            <input type="password" placeholder="Contrase??a actual" class="form-control-icon form-control">
                                            <i class="ri-key-line"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Nueva contrase??a</label>
                                        <div class="form-icon">
                                            <input type="password" placeholder="Nueva contrase??a" class="form-control-icon form-control">
                                            <i class="ri-key-2-line"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Confirmar nueva contrase??a</label>
                                        <div class="form-icon">
                                            <input type="password" placeholder="Confirmar nueva contrase??a" class="form-control-icon form-control">
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
            <!-- END MODAL Editar contrase??a del cliente -->


            <!-- MODAL Agregar/editar direcci??n -->
            <div id="modal-form-direccion" class="modal modal-lg fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0" id="modal-title"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form" action="<?=BASE_PATH?>adress-c">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-6">
                                        <label class="form-label">Nombre</label>
                                        <input id="first_name" type="text" placeholder="Nombre" class="form-control" name="first_name">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Apellido</label>
                                        <input id="last_name" type="text" placeholder="Apellido" class="form-control" name="last_name">
                                    </div>
                                    <div class="col-lg-9">
                                        <label class="form-label">Calle y n??mero</label>
                                        <input id="street_and_use_number" type="text" placeholder="Calle y n??mero" class="form-control" name="street_and_use_number">
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="form-label">C??digo postal</label>
                                        <input id="postal_code" type="number" placeholder="C??digo postal" class="form-control" name="postal_code">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label">Ciudad</label>
                                        <input id="city" type="text" placeholder="Ciudad" class="form-control" name="city">
                                    </div>
                                    <div class="col-lg-5">
                                        <label class="form-label">Provincia o estado</label>
                                        <input id="province" type="text" placeholder="Provincia o estado" class="form-control" name="province">
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="form-label">N??mero de tel??fono</label>
                                        <input id="phone_number" type="number" placeholder="N??mero de tel??fono" class="form-control" name="phone_number">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>

                                        <input id="hidden_input" type="hidden" name="action" value="create">
                                        <input id="id" type="hidden" name="id">
                                        <input type="hidden" name="global_token" value="<?=$_SESSION['global_token']?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Agregar/editar direcci??n -->

            <!-- MODAL Eliminar direcci??n -->
            <div id="modal-eliminar-direccion" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">??Est??s seguro de que quieres eliminar esta direcci??n?</h4>
                                <p class="text-muted mb-4">Esta acci??n es permanente y no podr?? ser revertida.</p>
                                <div class="hstack gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-danger">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Eliminar direcci??n -->

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

    <script type="text/javascript">
        function addAddress()
        {
            document.getElementById("modal-title").innerHTML = "Agregar direcci??n"; 
            document.getElementById("hidden_input").value = "create";
        }

        function editAddress(target)
        {
            let address = JSON.parse(target.getAttribute('data-product'));

            document.getElementById("modal-title").innerHTML = "Editar cliente"; 
            document.getElementById("hidden_input").value = "update";
            document.getElementById("fisrt_name").value = address.first_name;
            document.getElementById("last_name").value = address.last_name;
            document.getElementById("street_and_use_number").value = address.street_and_use_number;
            document.getElementById("postal_code").value = address.postal_code;
            document.getElementById("city").value = address.city;
            document.getElementById("province").value = address.province;
            document.getElementById("phone_number").value = address.phone_number;
            document.getElementById("id").value = address.id; 
        }
    </script>


</body>


</html>