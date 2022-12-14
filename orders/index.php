<?php 
    $base_ruta = "../"; 
	include $base_ruta."app/config.php";
    include $base_ruta."app/OrderController.php";
    include $base_ruta."app/ClientController.php";
    include $base_ruta."app/ProductController.php";
    include $base_ruta."app/CouponController.php";
    include $base_ruta."app/UserController.php";

    $orders = OrderController::getAllOrders();
    $clients = ClientController::getClients();
    $products = ProductController::getProducts();
    $coupons = CouponController::getAllCoupons();

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
    <title>Examen - Órdenes</title>
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>public/libs/nouislider/nouislider.min.css">

    <!-- gridjs css -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>public/libs/gridjs/theme/mermaid.min.css">

    <script src="https://unpkg.com/vue@3"></script>
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
                                            <h3 class="mb-0">Órdenes</h3>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button data-bs-target="#modal-form" data-bs-toggle="modal" class="btn-success btn fs-15" onclick="addOrder()">
                                                <i class="ri-add-line align-bottom me-1"></i> 
                                                Agregar orden
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table-hover align-middle table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Productos</th>
                                                    <th>Total de la orden</th>
                                                    <th>Estado de pago</th>
                                                    <th>Tipo de pago</th>
                                                    <th>Cupón</th>
                                                    <th>Dirección</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($orders as $order): ?>
                                                    <tr>
                                                        <td><?= $order->folio ?></td>
                                                        <td><?= count($order->presentations) ?></td>
                                                        <td>$ <?= $order->total ?? 0 ?></td>
                                                        <td><?= $order->order_status->name ?></td>
                                                        <td><?= $order->payment_type->name ?></td>
                                                        <td><?= $order->coupon->name ?? 'Sin cupón' ?></td>
                                                        <td><?= $order->address->street_and_use_number ?? "Sin dirección" ?></td>
                                                        <td class="text-center">
                                                            <a href="<?=BASE_PATH?>ordenes/info/<?=$order->id?>">
                                                                <button title="Detalles" class="btn-ghost-info btn-icon btn rounded-circle shadow-none" type="button">
                                                                    <i data-feather="info" class="icon-dual-info icon-sm"></i>
                                                                </button>
                                                            </a>
                                                            <button data-order='<?= json_encode($order) ?>' onclick="editOrder(this)" title="Editar estado de orden" data-bs-target="#modal-edit-status" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button">
                                                                <i data-feather="edit-2" class="icon-dual-warning icon-sm"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
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

            
            <!-- MODAL Agregar orden -->
            <div id="modal-form" class="modal modal-lg fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Agregar orden</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form" action="<?=BASE_PATH?>order-c">
                                <div class="row g-3 align-items-center">
                                    
                                    <div class="col-md-6">
                                        <label>Cliente</label>
                                        <select id="select_client" @change="setAddresses()" class="form-select" aria-label="Floating label select example" name="client_id">
                                            <option disabled selected>Seleccione una opción</option>
                                            <?php foreach($clients as $client): ?>
                                                <option value="<?=$client->id?>"><?=$client->name?></option>
                                            <?php endforeach; ?>  
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>Dirección</label>
                                        <select id="select_address" class="form-select" aria-label="Floating label select example" name="address_id">
                                            <option disabled selected>Seleccione una opción</option>
                                            <?php foreach($clients as $client): ?>
                                                <?php foreach($client->addresses as $address): ?>
                                                        <option value="<?=$address->id?>"><?=$address->street_and_use_number?></option>
                                                <?php endforeach; ?>  
                                            <?php endforeach; ?>
                                        </select>         
                                    </div>
                                    <div class="col-md-4">
                                        <label>Método de pago</label>
                                        <select class="form-select" aria-label="Floating label select example" name="payment_type_id">
                                            <option disabled selected>Seleccione una opción</option>
                                            <option value="1">Efectivo</option>
                                            <option value="2">Tarjeta</option>
                                            <option value="3">Transferencia</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Cupón</label>
                                        <select class="form-select" aria-label="Floating label select example" name="coupon_id">
                                            <option disabled selected>Seleccione una opción</option>
                                            <?php foreach($coupons as $coupon): ?>
                                                <option value="<?=$coupon->id?>"><?=$coupon->name?></option>
                                            <?php endforeach; ?>  
                                        </select>                                    
                                    </div>
                                    <div class="col-md-4">
                                        <label>Estado de la orden</label>
                                        <select name="order_status_id" class="form-select" aria-label="Floating label select example">
                                            <option disabled selected>Seleccione una opción</option>
                                            <option value="1">Pendiente de pago</option>
                                            <option value="2">Pagada</option>
                                            <option value="3">Enviada</option>
                                            <option value="4">Abandonada</option>
                                            <option value="5">Pendiente de enviar</option>
                                            <option value="6">Cancelada</option>
                                        </select>
                                    </div>
                                    <br>
                                    <template class="row" v-for="(presentation, index) in cartPresentations">
                                        <div class="col-md-8">
                                            <label>Presentaciones de productos</label>
                                            <select v-model="presentation.id" class="form-select" aria-label="Floating label select example" :name="'presentations['+index+'][id]'">
                                                <option value="0" disabled selected>Seleccione una opción</option>
                                                <?php foreach($products as $product): ?>
                                                    <?php foreach($product->presentations as $presentation): ?>
                                                        <?php if(($presentation->stock)>($presentation->stock_min)): ?>
                                                        <option value="<?=$presentation->id?>"><?=$presentation->description?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>  
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Cantidad</label>
                                            <input :name="'presentations['+index+'][quantity]'" type="number" class="form-control" v-model="presentation.quantity">
                                        </div> 
                                        <div class="col-md-1">
                                            <button @click="removePresentation(index)" type="button" class="btn btn-danger mt-4"><i class="bx bx-minus "></i></button>
                                        </div> 
   
                                    </template>
                                    <div class="col-md-12">
                                        <button @click="addPresentation()" type="button" class="btn btn-success"><i class="bx bx-plus "></i></button>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary" value="create" name="action">Aceptar</button>
                                        </div>
                                    </div>

                                    <input id="hidden_input" type="hidden" name="action" value="create">
                                    <input type="hidden" name="global_token" value="<?=$_SESSION['global_token']?>">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Agregar orden -->


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

            <!-- MODAL Eliminar orden -->
            <div id="modal-eliminar" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">¿Estás seguro de que quieres eliminar a esta orden?</h4>
                                <p class="text-muted mb-4">Esta acción es permanente y no podrá ser revertida.</p>
                                <div class="hstack gap-2 justify-content-center">
                                    <form method="POST" class="form" action="<?=BASE_PATH?>order-c">
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
            <!-- END MODAL Eliminar orden -->

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

    <script type="text/javascript">
        
        function addOrder()
        {
            document.getElementById("hidden_input").value = "create";
        }

        function editOrder(target)
        {
            let order = JSON.parse(target.getAttribute('data-order'));
            console.log(order)
            console.log(order.order_status_id)

            document.getElementById("edit_id").value = order.id; 
            document.getElementById("order_status").value = order.order_status_id;

            console.log(document.getElementById("order_status").value)

        }

        function removeOrder(id)
        {
           document.getElementById("id_delete").value = id;
           console.log(id)
        }

        const {createApp} = Vue;
        
        var app = createApp({
            data(){
                return {
                    cartPresentations: [{id: 0, quantity: ''}],
                }
            },
            methods: {
                addPresentation()
                {
                    this.cartPresentations.push({id: 0, quanity: ''});
                },
                removePresentation(index)
                {
                    this.cartPresentations.splice(index,1);
                },
            }
        }).mount('#modal-form')
    </script>

</body>


</html>