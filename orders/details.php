<?php 
    $base_ruta = "../";
    include $base_ruta."app/config.php";
    include $base_ruta."app/OrderController.php";
    include $base_ruta."app/UserController.php";

    $order = null;
    if(isset($_GET['id'])){
        $order = OrderController::getSpecificOrder($_GET['id']);
    }else{
        header("Location: ".BASE_PATH."ordenes");
    }

    if(is_null($order)){
        header("Location: ".BASE_PATH."ordenes");
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
                                        <span class="badge text-bg-primary fs-18"><?=$order->order_status->name ?? "Sin status" ?></span>
                                        <button data-order='<?= json_encode($order) ?>' onclick="editOrder(this)" title="Editar estado de orden" data-bs-target="#modal-edit-status" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button">
                                            <i data-feather="edit-2" class="icon-dual-warning icon-sm"></i>
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
                                    <h6 class="card-title mb-0">Presentaciones de la orden</h6>
                                </div>
                                <!-- Tabla de órdenes -->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0 align-middle">
                                            <tbody>
                                                <tr>
                                                    <th>Presentación</th>
                                                    <th>Imagen</th>
                                                    <th>Producto</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th></th>
                                                </tr>
                                                <?php foreach($order->presentations as $presentation): ?>
                                                    <tr>
                                                        <td><?=$presentation->description?></td>
                                                        <td>
                                                            <img src="<?= BASE_PATH?>public/images/products/<?=$presentation->cover?>" alt="<?=$presentation->description?>" class="rounded avatar-sm shadow">
                                                        </td>
                                                        <td><?=$presentation->product_id?></td>
                                                        <td><?=$presentation->current_price->amount?></td>
                                                        <td><?=$presentation->pivot->quantity?></td>
                                                        <td>
                                                            <a href="DANISEP">
                                                                <a href="<?=BASE_PATH?>productos/info/<?=$presentation->product_id?>" class="link-info">
                                                                    Detalles <i class="ri-arrow-right-line me-1"></i>
                                                                </a>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
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
                                                    <td class="text-muted"><?=$order->folio ?? "N/A"?></td>
                                                </tr>
                                                <!-- <tr>
                                                    <th scope="row">Producto - Presentación - Cantidad</th>
                                                    <td class="text-muted">DANISEP Producto - Presentación - Cantidad</td>
                                                </tr> -->
                                                <tr class="border-top">
                                                    <th scope="row">Nombre del cliente</th>
                                                    <td class="text-muted"><?=$order->client->name ?? "N/A" ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Correo electrónico</th>
                                                    <td class="text-muted"><?=$order->client->email ?? "N/A" ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Número de teléfono</th>
                                                    <td class="text-muted"><?=$order->client->phone_number ?? "N/A" ?> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Nivel</th>
                                                    <td class="text-muted"><?=$order->client->level_id ?? "N/A" ?></td>
                                                </tr>

                                                <tr class="border-top">
                                                    <th scope="row">Dirección</th>
                                                    <!-- O si no pues en filas separadas no se -->
                                                    <td class="text-muted"><?=$order->address->street_and_use_number ?? "N/A" ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">A nombre de</th>
                                                    <td class="text-muted"><?=$order->address->first_name ?? "N/A" ?> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Número de teléfono (dirección)</th>
                                                    <td class="text-muted"><?=$order->address->phone_number ?? "N/A" ?></td>
                                                </tr>
                                                <tr class="border-top">
                                                    <th scope="row">Total de la orden</th>
                                                    <td class="text-muted"><?=$order->total ?? "N/A" ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cupón utilizado</th>
                                                    <td class="text-muted"><?=$order->coupon->name ?? "N/A" ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Estado de pago</th>
                                                    <td class="text-muted"><?=$order->order_status->name ?? "N/A" ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tipo de pago</th>
                                                    <td class="text-muted"><?=$order->payment_type->name ?? "N/A" ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Estado de pago</th>
                                                    <td class="text-muted"><?=$order->is_paid ? "Pagada" : "No pagada" ?></td>
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
                            <form method="POST" class="form" action="<?=BASE_PATH?>order-c">
                                <div class="row g-3 align-items-center">

                                    <div class="col-md-12">
                                        <label>Estado de la orden</label>
                                        <select id="order_status" name="order_status_id" class="form-select" aria-label="Floating label select example">
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
                                    <input id="hidden_input" type="hidden" name="action" value="update">
                                    <input id="edit_id" type="hidden" name="id">
                                    <input type="hidden" name="global_token" value="<?=$_SESSION['global_token']?>">
                            
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

    <script type="text/javascript">
        function editOrder(target)
        {
            let order = JSON.parse(target.getAttribute('data-order'));
            console.log(order)
            console.log(order.order_status_id)

            document.getElementById("edit_id").value = order.id; 
            document.getElementById("order_status").value = order.order_status_id;

            console.log(document.getElementById("order_status").value)
        }
    </script>


</body>


</html>