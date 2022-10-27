<?php 
    $base_ruta = "../"; //Esta madre se la concateno en los include para no tener que cambiarlo manualmente y nomas cambiarlo una vez jejeje
	include $base_ruta."app/config.php";
    include $base_ruta."app/ProductController.php";
    include $base_ruta."app/BrandController.php";
    include $base_ruta."app/CategorieController.php";
    include $base_ruta."app/TagController.php";

    $products = (new ProductsController())->getProducts();
    $brands = (new BrandController())->getBrands();
    $categories = (new CategorieController())->getCategories();
    $tags = (new TagController())->getTags();
    
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
                                                <!-- Foreach para recorrer todos los productos -->
                                                <?php foreach($products as $product): ?>
                                                    <tr>
                                                        <!-- Imagen del producto -->
                                                        <td>
                                                            <img src="<?=$product->cover?>" alt="DANISEP Nombre del producto" class="rounded avatar-sm shadow">
                                                            <button title="Editar imagen del producto" data-bs-target="#modal-form-img" data-bs-toggle="modal" class="btn-ghost-warning btn btn-icon rounded-circle shadow-none" type="button">
                                                                <i data-feather="edit-2" class="icon-dual-warning icon-sm"></i>
                                                            </button>
                                                        </td>
                                                        <!-- Info del producto -->
                                                        <td><?=$product->name?></td>
                                                        <td><?=$product->brand->name ?? "Sin Marca"?></td>
                                                        <td><?=sizeof($product->presentations)?></td>
                                                        <td><?=$product->description?></td>

                                                        <td>
                                                            <!-- Si no tiene categorías -->
                                                            <?php if (sizeof($product->categories)==0) : ?>
                                                                <span class="badge badge-soft-primary fs-12">
                                                                    Sin categoría
                                                                </span>
                                                            <?php endif; ?>
                                                            <!-- Foreach para recorrer las categorías -->
                                                            <?php foreach($product->categories as $category): ?>
                                                                <span class="badge badge-soft-primary fs-12">
                                                                    <?=$category->name?>
                                                                </span>
                                                            <?php endforeach; ?>
                                                        </td>
                                                        <td>
                                                            <!-- Si no tiene etiquetas -->
                                                            <?php if (sizeof($product->tags)==0) : ?>
                                                            <span class="badge badge-soft-primary fs-12">
                                                                Sin etiqueta
                                                            </span>
                                                            <?php endif; ?>
                                                            <!-- Foreach para recorrer las etiquetas -->
                                                            <?php foreach($product->tags as $tag): ?>
                                                                <span class="badge badge-soft-secondary fs-12">
                                                                    <?=$tag->name?>
                                                                </span>
                                                            <?php endforeach; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <a href="<?=BASE_PATH?>productos/info/DANISEP">
                                                                <button title="Detalles" class="btn btn-icon btn-topbar btn-ghost-info rounded-circle shadow-none" type="button">
                                                                    <i data-feather="info" class="icon-sm icon-dual-info"></i>
                                                                </button>
                                                            </a>
                                                            <button title="Editar" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn btn-icon btn-topbar btn-ghost-warning rounded-circle shadow-none" type="button">
                                                                <i data-feather="edit-2" class="icon-sm icon-dual-warning"></i>
                                                            </button>
                                                            <button title="Eliminar" data-bs-toggle="modal" data-bs-target="#modal-eliminar" class="btn btn-icon btn-topbar btn-ghost-danger rounded-circle shadow-none" type="button">
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
                </div>
            </div>
            <!-- End Page-content -->

            
            <!-- MODAL Agregar/editar producto -->
            <div id="modal-form" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Agregar producto</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        <form method="POST" class="form" action="<?=BASE_PATH?>products-c" enctype="multipart/form-data">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-12">
                                        <label>Nombre</label>
                                        <input type="text" placeholder="Nombre" class="form-control" name="name">
                                    </div>
                                    <div class="col-lg-9">
                                        <label>Slug</label>
                                        <input type="text" placeholder="Slug" class="form-control" name="slug">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Marca</label>
                                        <select class="form-select" aria-label="Floating label select example" name="brand_id">
                                            <?php foreach($brands as $brand): ?>
                                                <option value="<?=$brand->id?>"><?=$brand->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- Aquí habría que hacer validación de que si está en modo de editar, 
                                    no deje moverle a la imagen, a lo mejor nomas con ponerlo en disabled o esconderlo o como vean, 
                                    a menos que quieran hacer otro modal idéntico pero sin ese campo-->
                                    <div class="col-lg-12">
                                        <label class="form-label">Imagen</label>
                                        <input type="file" class="form-control" name="cover">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Descripción</label>
                                        <textarea type="text" placeholder="Descripción" class="form-control" name="description"></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Características</label>
                                        <textarea type="text" placeholder="Características" class="form-control" name="features"></textarea>
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
                                                        
                                                        <?php foreach($categories as $category): ?>
                                                            <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox" id="<?=$category->id?>" name="categories[]" value="<?=$category->id?>">
                                                            <label class="form-check-label text-dark" for="formCheck1">
                                                                <?=$category->name?>
                                                            </label>
                                                        </div>
                                                        <?php endforeach; ?>
                                                        
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
                                                        <?php foreach($tags as $tag): ?>
                                                            <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox" id="<?=$tag->id?>" name="tags[]" value="<?=$tag->id?>">
                                                            <label class="form-check-label text-dark" for="formCheck1">
                                                                <?=$tag->name?>
                                                            </label>
                                                        </div>
                                                        <?php endforeach; ?>
                                                        <!-- FIN CHECKBOX DE CADA CATEGORÍA -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN ACORDEÓN ETIQUETAS -->

                                    <input type="hidden" name="global_token" value="<?=$_SESSION['global_token']?>">
                                    
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary" value="create" name="action">Crear</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL Agregar/editar producto -->


            <!-- MODAL Editar imagen de producto -->
            <div id="modal-form-img" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar imagen de producto</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="DANISEP">
                                <div class="row g-3 align-items-center">
                                    <div class="col-12">
                                        <label class="form-label">Imagen de producto</label>
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
            <!-- END MODAL Editar imagen de producto -->


            <!-- MODAL Eliminar producto -->
            <div id="modal-eliminar" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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