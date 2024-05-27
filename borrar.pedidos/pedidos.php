<?php
session_start();
if (empty($_SESSION["Usuario"])) {

    header("Location: ../logout.php");

    exit();
}

require_once '../funciones/conexion.php';
require_once '../funciones/pedidos.php';
$MiConexion=ConexionBD();

if(isset($_POST['submit'])){
    $filtro="WHERE v.VENTA_ID like '%". $_POST['search']. "%'"; } 
  else {
    $filtro=' ';
}



$ventas=listar_ventas($filtro,$MiConexion);
$CantidadVentas=count($ventas);

?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="./assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content_1="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>SysMoto V <?php echo $_SESSION['Version']; ?></title>

    <meta name="description" content_1="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js"></script>

        


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
                <?php include("../menus/head.php"); ?>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
          
            <div class="card">
            <h5 class="card-header">Venta - Pedidos</h5>
                <div class="table-responsive text-nowrap">


                <!-- ssssssssssssssssssssssssss -->

                <div class="container py-4 text-center">
                
                 
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
                          <label for="campo" class="col-form-label">Factura a buscar [N°]: </label>
                      </div>
                      <div class="col-auto">
                          <form method="post">
                      
                            <input type="search" name="search" placeholder=""/>
                            <button name="submit" class="btn btn-secondary" ><span class="tf-icons bx bx-search-alt bx-flashing"></span>&nbsp; Buscar</button>
                            
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

                              
                            <?php for ($i=0; $i<$CantidadVentas; $i++) { ?>               
                    
                              <tr>
                              <td><?php echo $ventas[$i]['Factura'] ;?></td>  
                              <td><?php echo $ventas[$i]['Vendedor'] ;?></td>  
                              <td><?php echo $ventas[$i]['Articulo'] ;?></td>  
                              <td><?php echo $ventas[$i]['Descripcion'] ;?></td>  
                              <td><?php echo $ventas[$i]['Precio_unitario'] ;?></td>  
                              <td><?php echo $ventas[$i]['Precio_final'] ;?></td>  
                              <td><?php echo $ventas[$i]['Fecha_Venta'] ;?></td>  
                              <td><?php echo $ventas[$i]['Estado_venta'] ;?></td>  
                              <td><?php echo $ventas[$i]['Cliente'] ;?></td>  
                              </tbody>
                          
                          
                              <?php } ?>
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
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  
  </body>
</html>