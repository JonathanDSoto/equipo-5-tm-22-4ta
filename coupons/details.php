<?php 
    $base_ruta = "../";
    include $base_ruta."app/config.php";
    include $base_ruta."app/CouponController.php";

    $coupon = null;
    if(isset($_GET['id'])){
        $coupon = CouponController::getSpecificCoupon($_GET['id']);
    }
    
    if(is_null($coupon)){
        $coupons = CouponController::getAllCoupons();
        foreach($coupons as $cupon){
            if($cupon->id == $_GET['id']){
                $coupon = $cupon;
            }
        }
    }

    if(!$coupon) header("Location: ".BASE_PATH."cupones");

    if(!isset($_SESSION['id'])){
        header("Location: ".BASE_PATH);
    }

    //widget
    $total_discount = 0;
    if ($coupon->percentage_discount){
        //$total_discount += (sizeof($coupon->orders) * (int)$coupon->amount_discount);
    }
    if ($coupon->amount_discount){
        $total_discount += (sizeof($coupon->orders) * (int)$coupon->amount_discount);
    }
?> 

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

	<?php include $base_ruta."layouts/head.template.php"; ?>
    <title>Examen - Detalle Cupón</title>
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
                                    <h3 class="mb-0">Detalles del cupón</h3>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <div class="hstack gap-3">
                                        <button title="Editar" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn btn-icon btn-topbar btn-ghost-warning rounded-circle shadow-none" type="button" data-coupon='<?= json_encode($coupon) ?>' onclick="editCoupon(this)" href="#">
                                            <i data-feather="edit-2" class="icon-sm icon-dual-warning"></i>
                                        </button>
                                        <button title="Eliminar" data-bs-toggle="modal" data-bs-target="#modal-eliminar" class="btn btn-icon btn-topbar btn-ghost-danger rounded-circle shadow-none" type="button" onclick="removeCoupon(<?= $coupon->id ?>)" href="#">
                                            <i data-feather="trash-2" class="icon-sm icon-dual-danger"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Nombre</th>
                                                    <td class="text-muted"><?=$coupon->name?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Código</th>
                                                    <td class="text-muted"><?=$coupon->code?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tipo de cupón</th>
                                                    <td class="text-muted"><?=$coupon->couponable_type?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cantidad de descuento</th>
                                                    <td class="text-muted"><?=$coupon->amount_discount?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Máximo de usos</th>
                                                    <td class="text-muted"><?=$coupon->max_uses?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Usos</th>
                                                    <td class="text-muted"><?=$coupon->count_uses?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Dinero mínimo en compra</th>
                                                    <td class="text-muted"><?=$coupon->min_amount_required?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Cantidad de productos mínima</th>
                                                    <td class="text-muted"><?=$coupon->min_product_required?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Fecha de inicio</th>
                                                    <td class="text-muted"><?=$coupon->start_date?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Fecha de finalización</th>
                                                    <td class="text-muted"><?=$coupon->end_date?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Estado</th>
                                                    <td class="text-muted"><?=$coupon->status?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Válido sólo en primera compra</th>
                                                    <td class="text-muted"><?=$coupon->valid_only_first_purchase ? "Sí" : "No"?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card bg-secondary">
                                        <div class="card-body p-0">
                                            <div class="py-3 px-3">
                                                <h5 class="text-white-75 text-uppercase fs-13">Órdenes con este cupón</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-shopping-bag-line display-6 text-white"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h2 class="mb-0"><span class="counter-value text-white" data-target="<?=sizeof($coupon->orders)?>">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col-12">
                                    <div class="card bg-success">
                                        <div class="card-body p-0">
                                            <div class="py-3 px-3">
                                                <h5 class="text-white-75 text-uppercase fs-13">Total de dinero descontado</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-money-dollar-circle-line display-6 text-white"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h2 class="mb-0"><span class="counter-value text-white" data-target="<?=$total_discount?>">0</span></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div><!-- end col -->

                    </div>
                    

                    <!-- Órdenes -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Órdenes con este cupón</h6>
                                </div>
                                <!-- Tabla de órdenes -->
                                 <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0 align-middle">
                                            <tbody>
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Total de la orden</th>
                                                    <th>Cliente</th>
                                                    <th>Estado de orden</th>
                                                    <th></th>
                                                </tr>
                                                <?php foreach($coupon->orders as $order): ?>
                                                    <tr>
                                                        <td><?=$order->folio?></td>
                                                        <td><?=$order->total ?? "0" ?></td>
                                                        <td><?=$order->client_id?></td>
                                                        <td><?=$order->order_status_id?></td>
                                                        <td>
                                                                <a href="<?=BASE_PATH?>ordenes/info/<?=$order->id?>" class="link-info">
                                                                    Detalles <i class="ri-arrow-right-line me-1"></i>
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
                    </div>
                </div>
            </div>
            <!-- End Page-content -->

                        <!-- MODAL Agregar/editar cupon -->
            <div id="modal-form" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0" id="modal-title"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <form method="POST" class="form" action="<?=BASE_PATH?>coupon-c" enctype="multipart/form-data">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-9">
                                        <label>Nombre</label>
                                        <input id="name" type="text" placeholder="Nombre" class="form-control" name="name">
                                    </div>
                                    <div class="col-lg-9">
                                        <label>Código</label>
                                        <input id="code" type="text" placeholder="Código" class="form-control" name="code">
                                    </div>
                                    <div class="col-lg-9">
                                        <label>Porcentaje de descuento</label>
                                        <input id="percentage_discount" type="text" placeholder="Porcentaje de descuento" class="form-control" name="percentage_discount">
                                    </div>
                                    <div class="col-lg-9">
                                        <label>Cantidad de descuento</label>
                                        <input id="amount_discount" type="text" placeholder="Cantidad de descuento" class="form-control" name="amount_discount">
                                    </div>
                                    <div class="col-lg-9">
                                        <label>Cantidad mínima de compra</label>
                                        <input id="min_amount_required" type="text" placeholder="Cantidad mínima de compra" class="form-control" name="min_amount_required">
                                    </div>
                                    <div class="col-lg-9">
                                        <label>Cantidad mínima de productos</label>
                                        <input id="min_product_required" type="text" placeholder="Cantidad mínima de productos" class="form-control" name="min_product_required">
                                    </div>
                                    <div class="col-lg-9">
                                        <label>Fecha inicio</label>
                                        <input type="date" id="start_date" name="start_date">
                                        <label>Fecha límite</label>
                                        <input type="date" id="end_date" name="end_date">
                                    </div>
                                    <div class="col-lg-9">
                                        <label>Máximo de usos</label>
                                        <input id="max_uses" type="text" placeholder="Máximo de usos" class="form-control" name="max_uses">
                                    </div>

                                    <div class="col-lg-9">
                                        <label>Válido solo en primera compra</label>
                                        <select class="form-select" aria-label="Floating label select example" name="valid_only_first_purchase">
                                            <option id="valid_only_first_purchase" value="1">Sí</option>
                                            <option id="valid_only_first_purchase" value="0">No</option>
                                        </select>

                                        <br>

                                        <label>Status</label>
                                        <select class="form-select" aria-label="Floating label select example" name="status">
                                            <option id="status" value="1">Activo</option>
                                            <option id="status" value="0">Inactivo</option>
                                        </select>
                                    </div>

                                    <!-- FIN ACORDEÓN ETIQUETAS -->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary" value="update" name="action">Aceptar</button>
                                        </div>
                                    </div>
                                    <input id="hidden_input" type="hidden" name="action" value="update">
                                    <input id="id" type="hidden" name="id">
                                    <input type="hidden" name="global_token" value="<?=$_SESSION['global_token']?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Agregar/editar cupon -->

            <!-- MODAL Eliminar cupon -->
            <div id="modal-eliminar" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">¿Estás seguro de que quieres eliminar este cupón?</h4>
                                <p class="text-muted mb-4">Esta acción es permanente y no podrá ser revertida.</p>
                                <div class="hstack gap-2 justify-content-center">
                                    <form method="POST" class="form" action="<?=BASE_PATH?>coupon-c">
                                        <input id="id_delete" type="hidden" name="id" value="0">
                                        <input type="hidden" name="global_token" value="<?=$_SESSION['global_token']?>">
                                        <input id="hidden_input" type="hidden" name="action" value="delete"> 

                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Eliminar coupon -->


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
        function editCoupon(target)
        {
            let coupon = JSON.parse(target.getAttribute('data-coupon'));
            console.log(coupon.name)
            console.log(coupon.id)

            document.getElementById("modal-title").innerHTML = "Editar cupón"; 
            document.getElementById("hidden_input").value = "update";

            document.getElementById("id").value = coupon.id; 
            document.getElementById("name").value = coupon.name;
            document.getElementById("code").value = coupon.code;
            document.getElementById("percentage_discount").value = coupon.percentage_discount;
            document.getElementById("min_amount_required").value = coupon.min_amount_required;
            document.getElementById("min_product_required").value = coupon.min_product_required;
            document.getElementById("start_date").value = coupon.start_date;
            document.getElementById("end_date").value = coupon.end_date;
            document.getElementById("max_uses").value = coupon.max_uses;
            document.getElementById("valid_only_first_purchase").value = coupon.valid_only_first_purchase;
        }

        function removeCoupon(id)
        {
           document.getElementById("id_delete").value = id;
           console.log(id)
        }
    </script>

</body>


</html>