<?php
session_start();
if (empty($_SESSION["Usuario"])) {

    header("Location: /sysmoto/logout.php");

    exit();
}

require_once '../funciones/conexion.php';

////






?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path=".../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content_1="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content_1="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >



  </head>

  <body>
    
  <!-- gaston -->
    <script src="./script.js" defer></script>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php include "../menus/menu.php";?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  
                  
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
               

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
          
            <div class="card">
                <h5 class="card-header">Pedidos</h5>
                <div class="table-responsive text-nowrap">


                <!-- ssssssssssssssssssssssssss -->

                <div class="container py-4 text-center">
                  <h2>Pedidos</h2>
                 
                  </div>

                  <div class="row g-4">
<!--
                      <div class="col-auto">
                          <label for="num_registros" class="col-form-label">Mostrar: </label>

                      </div>

                      

                      <div class="col-auto">
                          <select name="num_registros" id="num_registros" class="form-select">
                              <option value="2">2</option>
                              <option value="4">4</option>
                              <option value="8">8</option>
                              <option value="10">10</option>
                          </select>
                      </div>



                      <div class="col-auto">
                          <label for="num_registros" class="col-form-label">registros </label>
                      </div>
-->
                      <div class="col-2"></div>

                      <div class="col-auto">
                          <label for="campo" class="col-form-label">Factura a buscar [Numero]: </label>
                      </div>
                      <div class="col-auto">
                          <form method="post">
                            <input type="search" name="search" placeholder="Busqueda de articulos"/>
                            <button name="submit">Buscar</button>
                          </form>
                      </div>
                      <div class="col-auto">
                          
                      </div>

                      <div class="error-container" style="display: none">
                          <p></p>
                      </div>

                  </div>

                  
            
                  <div class="row py-4">
                      <div >
                          <table class="table table-striped">
                              <thead>
                                  <th>Factura</th>
                                  <th>Vendedor</th>
                                  <th>Articulo</th>
                                  <th>Descripcion</th>
                                  <th>Precio_unitario</th>
                                  <th>Precio_final</th>
                                  <th>Fecha_Venta</th>
                                  <th>Estado_venta</th>
                                  <th>Cliente</th>
                                  
                              </thead>

                              <!-- El id del cuerpo de la tabla. -->
                              <tbody class="table-border-bottom-0">

                              <?php

if(isset($_POST['submit']) or isset($_GET['page'])){
// or isset($_GET['page'])
require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();

if(isset($_POST['submit'])){
  $itemABuscar=$_POST['search'];
} else {
  $itemABuscar='';
}

/*
Paginacion
*/

$sqlSearch = "SELECT v.VENTA_ID as Factura, u.NOMBRE as Vendedor, dv.DETVENTA_ITEM as Articulo, a.ART_INFOADICIONAL as Descripcion,
a.ART_PRECIOCOMPRA as Precio_unitario, a.ART_PRECIOCOMPRA*0.5+a.ART_PRECIOCOMPRA as Precio_final,
v.VENTA_FECHAVENTA as Fecha_Venta, ev.ESTADOVENTA_NOMBRE as Estado_venta, c.CLIENTE_NOMBE as Cliente	
from detalleventa as dv, venta as v, usuarios as u, articulo as a, cliente as c, estadoventa as ev
where dv.VENTA_ID = v.VENTA_ID and
dv.ID = u.ID and
dv.ART_ID = a.ART_ID and
v.CLIENTE_ID = c.CLIENTE_ID and
v.ESTADOVENTA_ID = ev.ESTADOVENTA_ID and
v.VENTA_ID like '%$itemABuscar%' ";

$resBusqueda = mysqli_query($MiConexion,$sqlSearch);
$cantRegistros = mysqli_num_rows($resBusqueda);
$numPorPaginas = 5;
$totalPaginas= ceil($cantRegistros/$numPorPaginas);

for($btn=1; $btn<=$totalPaginas; $btn++){
  echo '<button class="btn btn-gray" ><a class="col-auto" href="pedidos.php?page='.$btn.'" class="text-light mx-1 my-5">'.$btn.'</a></button>';
}

if(isset($_GET['page'])){
  $page=$_GET['page'];
} else {
  $page=1;
}

$startLimit=($page-1)*$numPorPaginas;

$sqlSearch2 = "SELECT v.VENTA_ID as Factura, u.NOMBRE as Vendedor, dv.DETVENTA_ITEM as Articulo, a.ART_INFOADICIONAL as Descripcion,
a.ART_PRECIOCOMPRA as Precio_unitario, a.ART_PRECIOCOMPRA*0.5+a.ART_PRECIOCOMPRA as Precio_final,
v.VENTA_FECHAVENTA as Fecha_Venta, ev.ESTADOVENTA_NOMBRE as Estado_venta, c.CLIENTE_NOMBE as Cliente	
from detalleventa as dv, venta as v, usuarios as u, articulo as a, cliente as c, estadoventa as ev
where dv.VENTA_ID = v.VENTA_ID and
dv.ID = u.ID and
dv.ART_ID = a.ART_ID and
v.CLIENTE_ID = c.CLIENTE_ID and
v.ESTADOVENTA_ID = ev.ESTADOVENTA_ID and
v.VENTA_ID like '%$itemABuscar%' limit $startLimit , $numPorPaginas";

$resBusqueda = mysqli_query($MiConexion,$sqlSearch2);

///

if($resBusqueda or isset($_GET['page'])){
  
  if(mysqli_num_rows($resBusqueda)>0){

    while($row=mysqli_fetch_assoc($resBusqueda)){
      
      echo '<tr>';
      //version GET
      echo '<td>'.$row['Factura'].'</a></td>';
      echo '<td>'.$row['Vendedor'].'</td>';
      echo '<td>'.$row['Articulo'].'</td>';
      echo '<td>'.$row['Descripcion'].'</td>';
      echo '<td>'.$row['Precio_unitario'].'</td>';
      echo '<td>'.$row['Precio_final'].'</td>';
      echo '<td>'.$row['Fecha_Venta'].'</td>';
      echo '<td>'.$row['Estado_venta'].'</td>';
      echo '<td>'.$row['Cliente'].'</a></td>';
      echo '</tr>';

    }
    
  }else {
    echo '<h3>No se encontraron registros</h3>';
    

}



} 
}

                              ?>

                              </tbody>
                          
                          
                        
                        </table>

                        
                      </div>
                  </div>






                  <div class="row">
                      <div class="col-6">
                          <label id="lbl-total"></label>
                      </div>

                      <div class="col-6" id="nav-paginacion"></div>

                      <input type="hidden" id="pagina" value="1">
                      <input type="hidden" id="orderCol" value="0">
                      <input type="hidden" id="orderType" value="asc">
                  </div>
                </div>

<!-- ssssssssssssssssssssssssss -->

                  





                 </div>
            </div>

            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
             
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  
  </body>
</html>