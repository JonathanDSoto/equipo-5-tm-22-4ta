<?php 
    $base_ruta = "../";
    include $base_ruta."app/config.php";
    include $base_ruta."app/ProductController.php";

    $product = null;
    if(isset($_GET['id'])){
        $product = ProductController::getSpecificProduct($_GET['id']);
    }

    if(is_null($product)){
        header("Location: ".BASE_PATH."productos");
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


                    <!-- Imagen + info + agregar a carrito -->
                    <div class="row">
                        <div class="col-lg-9 col-sm-12">
                            <div class="card">
                                <!-- DATOS DE ARRIBA -->
                                <div class="card-body border-bottom">
                                    <div class="row gx-lg-5">

                                        <!-- IMAGEN PRODUCTO -->
                                        <div class="col-xl-4 col-md-4 mx-auto text-center">
                                            <div class="product-img-slider sticky-side-div">
                                                <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                                    <div class="swiper-slide">
                                                        <!-- <button title="Editar producto" data-bs-target="#modal-form-producto" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button">
                                                            <i data-feather="edit-2" class="icon-lg icon-dual-warning"></i>
                                                        </button> -->
                                                        <img src="<?=$product->cover?>" alt="<?=$product->name?>" class="img-fluid d-block" />

                                                    </div>
                                                </div>
                                                <!-- end swiper thumbnail slide -->
                                                <!--<button data-bs-target="#modal-form-producto-img" data-bs-toggle="modal" class="mt-2 btn btn-ghost-warning shadow-none align-middle">
                                                    <i data-feather="edit-2" class="icon-xs icon-dual-warning"></i>
                                                    Editar imagen
                                                </button>
                                                -->
                                            </div>
                                        </div>
                                        <!-- FIN IMAGEN PRODUCTO -->

                                        <div class="col-xl-8 col-md-8">
                                            <div class="mt-xl-0 mt-md-0 mt-5">

                                                <!-- Parte superior con nombre, marca, slug, botones -->
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h4><?=$product->name?></h4>
                                                        <div class="hstack gap-3 flex-wrap">
                                                            <div class="text-muted">Marca: <span class="text-primary fw-medium"><?=$product->brand->name ?? "Sin marca" ?></span></div>
                                                            <div class="vr"></div>
                                                            <div class="text-muted">Slug: <span class="text-body fw-medium"><?=$product->slug ?? "Sin slug" ?></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div>
                                                            <!--<button title="Editar producto" data-bs-target="#modal-form-producto" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button">
                                                                <i data-feather="edit-2" class="icon-lg icon-dual-warning"></i>
                                                            </button>
                                                            -->
                                                            <!-- <button title="Eliminar producto" data-bs-target="#modal-eliminar-producto" data-bs-toggle="modal" class="btn-ghost-danger btn-icon btn rounded-circle shadow-none" type="button">
                                                                <i data-feather="trash-2" class="icon-lg icon-dual-danger"></i>
                                                            </button> -->
                                                            <!-- <a href="apps-ecommerce-add-product.html" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ri-pencil-fill align-bottom"></i></a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Parte superior con nombre, marca, slug, botones -->


                                                <!-- Descripción y características -->
                                                <div class="row mt-4">
                                                    <div class="text-muted">
                                                        <h5 class="fs-14">Descripción del producto</h5>
                                                        <p><?=$product->description ?? "Sin descripción" ?></p>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="text-muted">
                                                        <h5 class="fs-14">Características del producto</h5>
                                                        <p><?=$product->features ?? "Sin características" ?></p>
                                                    </div>
                                                </div>
                                                <!-- END Descripción y características -->


                                                <!-- Categorías y etiquetas con badges -->
                                                <div class="row mt-4">
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="text-muted">
                                                            <h5 class="fs-14">Categorías</h5>
                                                            <?php foreach($product->categories as $category): ?>
                                                                <span class="badge badge-soft-primary fs-12 mb-1"><?=$category->name ?></span>
                                                            <?php endforeach; ?>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="text-muted">
                                                            <h5 class="fs-14">Etiquetas</h5>
                                                            <?php foreach($product->tags as $tag): ?>
                                                                <span class="badge badge-soft-primary fs-12 mb-1"><?=$tag->name ?></span>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Categorías y etiquetas con badges -->
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END DATOS DE ARRIBA -->
                            </div>
                        </div>

                        <!-- Formulario derecha comprar -->
                        <!--<div class="col-lg-3 col-sm-12">
                            <div class="card sticky-side-div">
                                <div class="card-body">
                                    <form action="DANISEP" class="align-middle">
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
                                                <option value="10">10 (máximo que pueda 10??)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 text-center">
                                            <h5 class="form-label">Subtotal: $4500</h5>
                                        </div>
                                        <div class="text-center">
                                            <button type="sumbit" class="btn btn-primary btn-label waves-effect waves-light">
                                                <i class="ri-shopping-cart-line label-icon align-middle fs-16 me-2"></i> Agregar al carrito
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>-->
                    </div>

                    <!-- Presentaciones -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <h3 class="mb-0">Presentaciones</h3>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button class="btn btn-success fs-15" data-bs-toggle="modal" data-bs-target="#modal-form-presentacion" onclick="addPresentation()">
                                                <i class="ri-add-line align-bottom me-1"></i> 
                                                Agregar presentación
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Código</th>
                                                    <th scope="col">Stock</th>
                                                    <th scope="col">Stock mínimo</th>
                                                    <th scope="col">Stock máximo</th>
                                                    <th scope="col">Peso</th>
                                                    <th scope="col">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Foreach para recorrer todos los productos -->
                                                <?php foreach($product->presentations as $presentation): ?>
                                                    <tr>
                                                        <!-- Info del producto -->
                                                        <td><?=$presentation->description ?? "Sin nombre/descripción" ?></td>
                                                        <td><?=$presentation->code ?? "Sin Código"?></td>
                                                        <td><?=$presentation->stock ?? "Sin Stock"?></td>
                                                        <td><?=$presentation->stock_min ?? "Sin Stock mínimo"?></td>
                                                        <td><?=$presentation->stock_max ?? "Sin Stock máximo"?></td>
                                                        <td><?=$presentation->weight_in_grams ?? "Sin Peso"?></td>
                                                        <td><?=$presentation->status ?? "Sin status"?></td>
                                                        <td class="text-center">
                                                            <button title="Editar" data-bs-toggle="modal" data-bs-target="#modal-form-presentacion" class="btn btn-icon btn-topbar btn-ghost-warning rounded-circle shadow-none" type="button" data-presentation='<?= json_encode($presentation) ?>' onclick="editPresentation(this)" href="#">
                                                                <i data-feather="edit-2" class="icon-sm icon-dual-warning"></i>
                                                            </button>
                                                            <button title="Eliminar" data-bs-toggle="modal" data-bs-target="#modal-eliminar-presentacion" class="btn btn-icon btn-topbar btn-ghost-danger rounded-circle shadow-none" type="button" onclick="removePresentation(<?= $presentation->id ?>)" href="#">
                                                                <i data-feather="trash-2" class="icon-sm icon-dual-danger"></i>
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


                    <!-- Órdenes -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Órdenes del producto</h6>
                                </div>
                                <!-- Tabla de órdenes -->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0 align-middle">
                                            <tbody>
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Presentación</th>
                                                    <th>Cantidad</th>
                                                    <th>Total de la orden</th>
                                                    <th>Cliente</th>
                                                    <th>Estado de orden</th>
                                                    <th></th>
                                                </tr>
                                                <?php foreach($product->presentations as $presentation): ?>
                                                    <?php foreach($presentation->orders as $order): ?>
                                                        <tr>
                                                            <td><?=$order->folio?></td>
                                                            <td><?=$presentation->description?></td>
                                                            <td><?=$order->pivot->quantity?></td>
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

            <!-- MODAL Editar producto -->
            <div id="modal-form-producto" class="modal modal-lg fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar producto</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-12">
                                        <label>Nombre</label>
                                        <input type="text" placeholder="Nombre" class="form-control">
                                    </div>
                                    <div class="col-lg-9">
                                        <label>Slug</label>
                                        <input type="text" placeholder="Slug" class="form-control">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Marca</label>
                                        <select class="form-select" aria-label="Floating label select example">
                                            <option value="0">DANISEP Marca</option>
                                        </select>
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


            <!-- MODAL Editar imagen del producto -->
            <div id="modal-form-producto-img" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar imagen del producto</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-12">
                                        <label>Imagen del producto</label>
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
            <!-- END MODAL Editar imagen del producto -->


            <!-- MODAL Eliminar producto -->
            <div id="modal-eliminar-producto" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
            <div id="modal-form-presentacion" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0" id="modal-title"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form" action="<?=BASE_PATH?>presentation-c" enctype="multipart/form-data">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-14">
                                        <label class="form-label">Descripción</label>
                                        <input id="description" name="description"type="text" placeholder="Descripción" class="form-control">
                                    </div>
                                    <!-- Aquí habría que hacer validación de que si está en modo de editar, 
                                    no deje moverle a la imagen, a lo mejor nomas con ponerlo en disabled o esconderlo o como vean, 
                                    a menos que quieran hacer otro modal idéntico pero sin ese campo-->
                                    <div class="col-lg-12" id="modal-imagen">
                                        <label class="form-label">Imagen</label>
                                        <input id="cover" name="cover" type="file" class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label">Código</label>
                                        <input id="code" name="code" type="text" placeholder="Código" class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label">Peso (en gramos)</label>
                                        <input id="weight_in_grams" name="weight_in_grams" type="number" placeholder="Peso en gramos" class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label">Estado</label>
                                        <select id="status" name="status" class="form-select">
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label">Stock</label>
                                        <input id="stock" name="stock" type="number" placeholder="Stock" class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label">Stock mínimo</label>
                                        <input id="stock_min" name="stock_min" type="number" placeholder="Stock mínimo" class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label">Stock máximo</label>
                                        <input id="stock_max" name="stock_max" type="number" placeholder="Stock máximo" class="form-control">
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary" value="create" name="action">Aceptar</button>
                                        </div>
                                    </div>

                                    <input id="hidden_input" type="hidden" name="action" value="create">
                                    <input id="id" type="hidden" name="id">
                                    <input id="amount" type="hidden" name="amount" value="1">
                                    <input id="product_id" type="hidden" name="product_id" value="<?=$product->id?>">
                                    <input type="hidden" name="global_token" value="<?=$_SESSION['global_token']?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Agregar/editar presentacion -->


            <!-- MODAL Editar imagen de presentación -->
            <div id="modal-form-presentacion-img" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar imagen de presentación</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-12">
                                        <label class="form-label">Imagen de presentación</label>
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
            <!-- END MODAL Editar imagen de presentación -->


            <!-- MODAL Eliminar presentacion -->
            <div id="modal-eliminar-presentacion" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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

    <script type="text/javascript">
        function addPresentation()
        {
            document.getElementById("modal-title").innerHTML = "Agregar presentación"; 
            document.getElementById("hidden_input").value = "create";
            document.getElementById("acordeon-categorias").style.display = 'block';
            document.getElementById("acordeon-etiquetas").style.display = 'block';
            document.getElementById("modal-imagen").style.display = 'block';
        }

        function editPresentation(target)
        {
            let presentation = JSON.parse(target.getAttribute('data-presentation'));
            console.log(presentation.name)
            console.log(presentation.id)

            document.getElementById("modal-imagen").style.display = 'none';
            document.getElementById("modal-title").innerHTML = "Editar presentación"; 
            document.getElementById("hidden_input").value = "update";

            document.getElementById("features").value = presentation.features;
            document.getElementById("id").value = presentation.id; 
            document.getElementById("name").value = presentation.name;
            document.getElementById("description").value = presentation.description;
            document.getElementById("code").value = presentation.code;
            document.getElementById("weight_in_grams").value = presentation.weight_in_grams;
            document.getElementById("status").value = presentation.status;
            document.getElementById("stock").value = presentation.stock;
            document.getElementById("stock_min").value = presentation.stock_min;
            document.getElementById("stock_max").value = presentation.stock_max;
            document.getElementById("amount").value = presentation.amount;
            document.getElementById("product_id").value = presentation.product_id;
            document.getElementById("cover").value = presentation.cover;
        }

        function removePresentation(id)
        {
           document.getElementById("id_delete").value = id;
           console.log(id)
        }
    </script>

</body>


</html>