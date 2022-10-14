        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= BASE_PATH ?>public/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= BASE_PATH ?>public/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= BASE_PATH ?>public/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= BASE_PATH ?>public/images/logo-light.png" alt="" height="17">
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
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="widgets.html">
                                <i class="mdi mdi-account"></i> <span data-key="t-widgets">Usuarios</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="widgets.html">
                                <i class="mdi mdi-card-account-details"></i> <span data-key="t-widgets">Clientes</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= BASE_PATH ?>productos">
                                <i class="mdi mdi-storefront-outline"></i> <span data-key="t-widgets">Productos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                                <i class="mdi mdi-view-grid-outline"></i> <span data-key="t-layouts">Catálogos</span>
                            </a>
                            <div class="collapse menu-dropdown show" id="sidebarLayouts">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="<?= BASE_PATH ?>catalogos/marcas" class="nav-link" target="_blank" data-key="t-horizontal"><i class="mdi mdi-earth"></i>Marcas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= BASE_PATH ?>catalogos/categorias" class="nav-link" target="_blank" data-key="t-detached"><i class="mdi mdi-apps"></i>Categorías</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= BASE_PATH ?>catalogos/etiquetas" class="nav-link" target="_blank" data-key="t-two-column"><i class="mdi mdi-tag-outline"></i>Etiquetas</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="widgets.html">
                                <i class="mdi mdi-ticket-outline"></i> <span data-key="t-widgets">Cupones</span>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="widgets.html">
                                <i class="mdi mdi-list-status"></i> <span data-key="t-widgets">Órdenes</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        
