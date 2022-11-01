<?php 
    $base_ruta = "../../";
    include $base_ruta."app/config.php";
    include $base_ruta."app/TagController.php";
    $tags = TagController::getTags();
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
    <title>Examen - Etiquetas</title>

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
                                    <h3 class="mb-0">Etiquetas</h3>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-success fs-15" data-bs-toggle="modal" data-bs-target="#modal-form" onclick="addTag()">
                                        <i class="ri-add-line align-bottom me-1"></i> 
                                        Agregar etiqueta
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- INICIO CARD DE LA ETIQUETA -->
                        <?php foreach($tags as $tag): ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 me-3">
                                                <h6 class="card-title mb-0">
                                                    <?=$tag->name ?? "Sin nombre" ?>
                                                </h6>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <ul class="list-inline card-toolbar-menu d-flex align-items-center mb-0">
                                                    <li class="list-inline-item">
                                                        <button title="Editar" data-bs-target="#modal-form" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button" data-tag='<?= json_encode($tag) ?>' onclick="editTag(this)" href="#">
                                                            <i data-feather="edit-2" class="icon-xs icon-dual-warning"></i>
                                                        </button>
                                                        <button title="Eliminar" data-bs-target="#modal-eliminar" data-bs-toggle="modal" class="btn-ghost-danger btn-icon btn rounded-circle shadow-none" type="button" onclick="removeTag(<?= $tag->id ?>)" href="#">
                                                            <i data-feather="trash-2" class="icon-xs icon-dual-danger"></i>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text" style="display: -webkit-box;-webkit-line-clamp: 5;-webkit-box-orient: vertical;text-overflow: ellipsis;">
                                            <?=$tag->description ?? "Sin descripción" ?>
                                        </p>
                                        <p class="card-text text-secondary"><small>
                                            <?=isset($tag->products) ? sizeof($tag->products) : 0 ?> productos
                                        </small></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- FIN CARD DE LA ETIQUETA -->
                </div>
            </div>
            <!-- End Page-content -->


            <!-- MODAL Agregar/editar etiqueta -->
            <div id="modal-form" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0" id="modal-title"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" class="form" action="<?=BASE_PATH?>tag-c">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input id="name" type="text" placeholder="Nombre" class="form-control" name="name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input id="slug" type="text" placeholder="Slug" class="form-control" name="slug">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea id="description" type="text" placeholder="Descripción" class="form-control" name="description"></textarea>
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                </div>

                                <input id="hidden_input" type="hidden" name="action" value="create">
                                <input id="id" type="hidden" name="id">
                                <input type="hidden" name="global_token" value="<?=$_SESSION['global_token']?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- MODAL Agregar/editar etiqueta -->

            <!-- MODAL Eliminar etiqueta -->
            <div id="modal-eliminar" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">¿Estás seguro de que quieres eliminar esta etiqueta?</h4>
                                <p class="text-muted mb-4">Esta acción es permanente y no podrá ser revertida.</p>
                                <div class="hstack gap-2 justify-content-center">
                                    <form method="POST" class="form" action="<?=BASE_PATH?>tag-c">
                                        <input id="id_delete" type="hidden" name="id" value="0">
                                        <input type="hidden" name="global_token" value="<?=$_SESSION['global_token']?>">
                                        <input id="hidden_input" type="hidden" name="action" value="delete"> 

                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- END MODAL Eliminar etiqueta -->

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
        function addTag()
        {
            document.getElementById("modal-title").innerHTML = "Agregar etiqueta"; 
            document.getElementById("hidden_input").value = "create";
        }

        function editTag(target)
        {
            let tag = JSON.parse(target.getAttribute('data-tag'));
            console.log(tag.name)
            console.log(tag.id)

            document.getElementById("id").value = tag.id; 
            document.getElementById("hidden_input").value = "update";
            document.getElementById("name").value = tag.name;
            document.getElementById("description").value = tag.description;
            document.getElementById("slug").value = tag.slug;
            document.getElementById("modal-title").innerHTML = "Editar etiqueta"; 
        }

        function removeTag(id)
        {
           document.getElementById("id_delete").value = id;
           console.log(id)
        }
    </script>

</body>


</html>