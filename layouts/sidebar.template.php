        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box mb-3">
                <!-- Dark Logo-->
                <!-- <a href="index.html" class="logo logo-dark">
                    <span class="logo-lg logo-sm">
                        <img src="<?= BASE_PATH ?>public/images/logo.png" alt="" height="50">
                    </span>
                </a> -->
                <!-- Light Logo-->
                <a href="<?= BASE_PATH ?>productos" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="<?= BASE_PATH ?>public/images/logo.png" alt="Logo" height="50">
                    </span>
                </a>
                <a href="<?= BASE_PATH ?>productos" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= BASE_PATH ?>public/images/logo.png" alt="Logo" height="15">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">

                        <li class="menu-title"><span data-key="t-menu">TIENDA</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= BASE_PATH ?>productos">
                                <!-- La verdad no sé qué hace este data-key ni ninguno jejeje -->
                                <i class="mdi mdi-storefront-outline"></i> <span data-key="t-widgets">Productos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?=BASE_PATH?>ordenes">
                                <i class="mdi mdi-list-status"></i> <span data-key="t-widgets">Órdenes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?=BASE_PATH?>cupones">
                                <i class="mdi mdi-ticket-outline"></i> <span data-key="t-widgets">Cupones</span>
                            </a>
                        </li> 

                        <li class="menu-title"><span data-key="t-menu">CATÁLOGOS</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= BASE_PATH ?>catalogos/marcas">
                                <i class="mdi mdi-earth"></i> <span data-key="t-widgets">Marcas</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= BASE_PATH ?>catalogos/categorias">
                                <i class="mdi mdi-apps"></i> <span data-key="t-widgets">Categorías</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= BASE_PATH ?>catalogos/etiquetas">
                                <i class="mdi mdi-tag-outline"></i> <span data-key="t-widgets">Etiquetas</span>
                            </a>
                        </li>

                        <li class="menu-title"><span data-key="t-menu">PERSONAS</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?=BASE_PATH?>usuarios">
                                <i class="mdi mdi-account-group"></i> <span data-key="t-widgets">Usuarios</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?=BASE_PATH?>clientes">
                                <i class="mdi mdi-card-account-details"></i> <span data-key="t-widgets">Clientes</span>
                                <!-- <i class="mdi mdi-account-cash"></i> <span data-key="t-widgets">Clientes</span> -->
                            </a>
                        </li> 
                        <li class="nav-item">
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        
