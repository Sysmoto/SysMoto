<?php
session_start();
//print_r($_SESSION);
if (empty($_SESSION["Usuario"])) {

    header("Location: ../logout.php");

    exit();
}

require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();
require_once '../funciones/articulos.php';

$articulos=Listar_articulos($MiConexion);
$CantidadArticulos=count($articulos);
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>SysMoto V <?php echo $_SESSION['Version']; ?></title>

    <meta name="description" content="" />

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
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php include("../menus/menu.php");?>
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

            
                
            
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Articulos</h4> 
              <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="/stock/alta_articulo.php"><i class="bx bx-package bx-flashing"></i> Nuevo</a>
                    </li> 
                    <li class="nav-item">&nbsp;&nbsp;&nbsp;&nbsp;</lib>
                    <li class="nav-item">
                    <a class="nav-link active" href="/stock/listadopdf.php" target="_blank" ><i class="bx bx-table bx-flashing"></i> Listado a imprimir</a>
                    </li>
                  </ul>
            </div> 
              <form method='post' action="articulo.php" enctype="multipart/form-data" >
              <div class="card">
                
                <div class="table-responsive text-nowrap">
                  <table class="table" id="example2">
                    <thead>
                      <tr>
                        <th>Articulo</th>
                        <th>Codigo</th>                        
                        <th>Cantidad</th>
                        <th>Alerta</th>
                        <th>Estado</th>
                        <th>Ubicacion</th>
                        <th>Precio</th>
                        <th>Accion</th>  
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php for ($i=0; $i<$CantidadArticulos; $i++) { ?>               
                    
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> 
                        <strong><?php echo $articulos[$i]['ART_INFOADICIONAL']?></strong></td>
                        <td><?php echo $articulos[$i]['ART_CODIGO'] ;?></td>
                        <td><?php echo $articulos[$i]['CANT_STOCK'] ;?></td>
                        <td><?php 
                        switch ($articulos[$i]['ESTADOALERTA_ID']){
                          case 1: ?> 
                                <span class="badge rounded-pill bg-label-success"> 
                                <?php echo $articulos[$i]['ESTADOALERTA_NOMBRE']."</span>";
                                break; 
                          case 2: ?> 
                                <span class="badge rounded-pill bg-label-warning"> 
                                <?php echo $articulos[$i]['ESTADOALERTA_NOMBRE']."</span>";
                                break; 
                          case 3: ?> 
                                <span class="badge rounded-pill bg-label-danger"> 
                                <?php echo $articulos[$i]['ESTADOALERTA_NOMBRE']."</span>";
                                break; ?>
                        <?php } ?> 
                      
                        </td>
                        <td>
                        <?php 
                        switch ($articulos[$i]['EST_ART']){
                          case 1: ?> 
                                <span class="badge rounded-pill bg-label-success"> 
                                <?php echo $articulos[$i]['ESTADOART_NOMBRE']."</span>";
                                break; 
                          case 2: ?> 
                                <span class="badge rounded-pill bg-label-warning"> 
                                <?php echo $articulos[$i]['ESTADOART_NOMBRE']."</span>";
                                break; 
                          case 3: ?> 
                                <span class="badge rounded-pill bg-label-danger"> 
                                <?php echo $articulos[$i]['ESTADOART_NOMBRE']."</span>";
                                break; ?>
                        <?php } ?> 
                        </td>
                        <td><?php echo $articulos[$i]['ART_UBICACION'];?></td>
                        <td><?php echo $articulos[$i]['ART_PRECIOCOMPRA'];?></td>   
                        <td>
                          <button type="submit" class="btn btn-secondary" name="id_articulo" value="<?php echo $articulos[$i]['ART_ID'];?>" >
                            <span class="bx bx-package fade-right"></span>&nbsp; Ver 
                          </button> 
                        </td>
                      </tr>
                      <?php } ?>
                      </tbody>
                  </table>
                 
                </div>
              </div>
             
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

    <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
      </form>
  </body>
</html>
