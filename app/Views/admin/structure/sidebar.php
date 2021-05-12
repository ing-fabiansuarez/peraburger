 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="<?= base_url() ?>/public/img/peraburgelogo1.png" alt="Logo" class="img-fluid" style="opacity: .8">
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="<?= base_url() ?>/public/admin/dist/img/employees/avatar_man.png" class="img-circle elevation-2" alt="Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">Fabian Suarez</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item menu-open">
                     <a href="<?= base_url()?>" class="nav-link active">
                         <i class="nav-icon fas fa-home"></i>
                         <p>
                             Inicio
                         </p>
                     </a>
                 </li>
                 <li class="nav-item menu-open">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-home"></i>
                         <p>
                             Estadisticas
                         </p>
                     </a>
                 </li>
                 <li class="nav-header">PEDIDOS</li>
                 <li class="nav-item">
                     <a href="<?=base_url().route_to('view_createorder')?>" class="nav-link">
                         <i class="nav-icon fas fa-edit"></i>
                         <p>
                             Crear Pedido
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Lista de Pedidos
                             <i class="fas fa-angle-left right"></i>
                             <span class="badge badge-info right">6</span>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="pages/layout/top-nav.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Top Navigation</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Top Navigation + Sidebar</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/boxed.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Boxed</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Sidebar</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Sidebar <small>+ Custom Area</small></p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Navbar</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/fixed-footer.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Fixed Footer</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Collapsed Sidebar</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <li class="nav-header">CLIENTES</li>
                 <li class="nav-item">
                     <a href="<?=base_url().route_to('view_createclient')?>" class="nav-link">
                         <i class="nav-icon fas fa-edit"></i>
                         <p>
                             Crear Cliente
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li>


             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>