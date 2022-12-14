<?php 
    $base_ruta = "../"; //Esta madre se la concateno en los include para no tener que cambiarlo manualmente y nomas cambiarlo una vez jejeje
    include $base_ruta."app/config.php";
    include $base_ruta."app/UserController.php";

    $users = UserController::getUsers();
    
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

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <h3 class="mb-0">Usuarios</h3>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button data-bs-target="#modal-form" data-bs-toggle="modal" class="btn-success btn fs-15" onclick="addUser()">
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
                                                    <th scope="col">Foto de perfil</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Apellidos</th>
                                                    <th scope="col">Rol</th>
                                                    <th scope="col">Correo electr??nico</th>
                                                    <th scope="col">N??mero de tel??fono</th>
                                                </tr>
                                            </thead>
                                            <?php foreach($users as $user): ?>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <img src="<?= $user->avatar?>" alt="<?= $user->name?>" class="avatar-sm rounded shadow">
                                                            <!--<button title="Editar avatar del usuario" data-bs-target="#modal-form-img" data-bs-toggle="modal" class="btn-ghost-warning btn btn-icon rounded-circle shadow-none" type="button">
                                                                <i data-feather="edit-2" class="icon-dual-warning icon-sm"></i>
                                                            </button>
                                                            -->
                                                        </td>
                                                        <td><?= $user->name ?? "Sin nombre" ?></td>
                                                        <td><?= $user->lastname ?? "Sin apellidos" ?></td>
                                                        <td><?= $user->role ?? "Sin rol" ?></td>
                                                        <td><?= $user->email ?? "Sin email" ?></td>
                                                        <td><?= $user->phone_number ?? "Sin n??mero de tel??fono" ?></td>

                                                        <td class="text-center">
                                                            <a href="<?=BASE_PATH?>usuarios/info/<?= $user->id?>">
                                                                <button title="Detalles" class="btn-ghost-info btn-icon btn rounded-circle shadow-none" type="button">
                                                                    <i data-feather="info" class="icon-dual-info icon-sm"></i>
                                                                </button>
                                                            </a>
                                                            <button title="Editar usuario" data-bs-target="#modal-form" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button" data-product='<?= json_encode($user) ?>' onclick="editUser(this)" href="#">
                                                                <i data-feather="edit-2" class="icon-dual-warning icon-sm"></i>
                                                            </button>
                                                            <button title="Editar contrase??a del usuario" data-bs-target="#modal-form-contrasenia" data-bs-toggle="modal" class="btn-ghost-warning btn-icon btn rounded-circle shadow-none" type="button">
                                                                <i class="ri-key-line icon-dual-warning fs-20"></i>
                                                            </button>
                                                            <button title="Eliminar usuario" data-bs-target="#modal-eliminar" data-bs-toggle="modal" class="btn-ghost-danger btn-icon btn rounded-circle shadow-none" type="button" onclick="removeUser(<?= $user->id ?>)" href="#">
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

            
            <!-- MODAL Agregar/editar user -->
            <div id="modal-form" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0" id="modal-title"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" class="form" action="<?=BASE_PATH?>user-c" enctype="multipart/form-data">
                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-12">
                                        <label>Nombre</label>
                                        <input id="name" type="text" placeholder="Nombre" class="form-control" name="name">
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Apellido</label>
                                        <input id="lastname" type="text" placeholder="Apellido" class="form-control" name="lastname">
                                    </div>
                                
                                    <!-- Input with Icon -->
                                    <div class="col-lg-12">
                                        <label class="form-label">Correo electr??nico</label>
                                        <div class="form-icon">
                                            <input id="email" type="email" placeholder="example@gmail.com" class="form-control-icon form-control" name="email">
                                            <i class="ri-mail-line"></i>
                                        </div>
                                    </div><div class="col-lg-12">
                                        <label>Rol</label>
                                        <input id="role" type="text" placeholder="Rol" class="form-control" name="role">
                                    </div>
                                    <div class="col-lg-12" id="modal-imagen">
                                        <label class="form-label">Foto de perfil</label>
                                        <input id="cover" type="file" class="form-control" name="cover">
                                    </div>
                                    <!-- Esconder ambas comtrase??as aqu?? cuando est?? en modo de editar, el editar contrase??a es un modal aparte -->
                                    <div class="col-lg-6">
                                        <label class="form-label">Contrase??a</label>
                                        <div class="form-icon">
                                            <input id="password" type="password" placeholder="Contrase??a" class="form-control-icon form-control" name="password">
                                            <i class="ri-key-line"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Confirmar contrase??a</label>
                                        <div class="form-icon">
                                            <input id="password2" type="password" placeholder="Confirmar contrase??a" class="form-control-icon form-control" name="password2">
                                            <i class="ri-key-fill"></i>
                                        </div>
                                    </div>
                                    <!-- Input with Icon -->
                                    <div class="col-lg-6">
                                        <label class="form-label">N??mero de tel??fono</label>
                                        <div class="form-icon">
                                            <input id="phone_number" type="number" placeholder="N??mero de tel??fono" class="form-control-icon form-control" name="phone_number">
                                            <i class="ri-phone-line"></i>
                                        </div>
                                    </div>

                                    </div><div class="col-lg-12">
                                        <label>Creado por</label>
                                        <input id="created_by" type="text" placeholder="Creado por" class="form-control" name="created_by">
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
            <!-- END MODAL Editar user -->


            <!-- MODAL Editar contrase??a del usuario -->
            <div id="modal-form-contrasenia" class="modal modal-sm fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 overflow-hidden">
                        <div class="modal-header p-3">
                            <h4 class="card-title mb-0">Editar contrase??a del usuario</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form" action="<?=BASE_PATH?>user-c">
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
            <!-- END MODAL Editar contrase??a del usuario -->


            <!-- MODAL Eliminar usere -->
            <div id="modal-eliminar" class="modal modal-sm fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <lord-icon src="https://cdn.lordicon.com/wdqztrtx.json" trigger="loop" colors="primary:#f06448" style="width:120px;height:120px">
                            </lord-icon>
                            <div class="mt-4">
                                <h4 class="mb-3">??Est??s seguro de que quieres eliminar a este usuario?</h4>
                                <p class="text-muted mb-4">Esta acci??n es permanente y no podr?? ser revertida.</p>
                                <div class="hstack gap-2 justify-content-center">
                                    <form method="POST" class="form" action="<?=BASE_PATH?>user-c">
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
            <!-- END MODAL Eliminar user -->

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
        function addUser()
        {
            var pass1 = document.getElementById("password")
            var pass2 = document.getElementById("password2");
            if(pass1.value != pass2.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            }else {
                document.getElementById("modal-title").innerHTML = "Agregar usuario"; 
                document.getElementById("hidden_input").value = "create";
                document.getElementById("password").style.display = 'block';
                document.getElementById("password2").style.display = 'block';
            }
        }

        function editUser(target)
        {
            let user = JSON.parse(target.getAttribute('data-product'));

            document.getElementById("modal-title").innerHTML = "Editar usuario"; 
            document.getElementById("hidden_input").value = "update";
            document.getElementById("name").value = user.name;
            document.getElementById("lastname").value = user.lastname;
            document.getElementById("id").value = user.id; 
            document.getElementById("email").value = user.email;
            document.getElementById("phone_number").value = user.phone_number;
            document.getElementById("created_by").value = user.created_by;
            document.getElementById("role").value = user.role;
            document.getElementById("password").style.display = 'none';
            document.getElementById("password2").style.display = 'none';
        }

        function removeUser(id)
        {
           document.getElementById("id_delete").value = id;
           console.log(id)
        }
    </script>


</body>


</html>