<?php
session_start();
//print_r($_SESSION);
if (empty($_SESSION["Usuario"])) {

    header("Location: ../logout.php");

    exit();
}

require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();
require_once '../funciones/clientes.php';
//$CantidadDatos=count($datos_articulo);
//$marcas=listar_marcas($MiConexion);

$provincias =listar_provincias($MiConexion);
$CantidadProv=count($provincias);

if(isset($_POST["DarAlta"])) {
  //$imgContent="";
  print_r($_POST);
  
   
  //  echo "<script> 
    //     alert('$statusMsg') 
      //   window.open('/stock/articulos.php','_top')
        //  </script>";
         
  }

  if(isset($_POST["borrar_imagen"])) {
    $borrar_imagen=borrarimagen($_POST,$MiConexion);  
    echo "<script> 
         alert('$borrar_imagen') 
         window.open('/stock/articulos.php','_top')
          </script>"; 
  }
   
 //  echo "<script> 
   //       alert('Se a cambiado datos de $usuario $modificar_usuario') 
    //      window.open('//usuarios/usuarios.php','_top')
      //   </script>";
//}


?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>SysMoto v0.0</title>

    <meta name="description" content="" />

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

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script language="javascript">
    $(document).ready(function(){
      $("#Provincia").on('change', function () {
        $("#Provincia option:selected").each(function () {
            var id_prov = $(this).val();
            $.post("ciudades.php", { id_prov: id_prov }, function(data) {
                $("#Ciudad").html(data);
            });			
        });
   });
});
</script>
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Alta de Cliente</h4> 
              <div class="col-md-12">
                  
            </div> 
              <form method='post' action="" enctype="multipart/form-data">
              <div class="card">
                
                      
                    <hr class="my-0" />
                    <div class="card-body">
                    <h5 class="card-header">Detalles Cliente</h5>
                    <!-- Account -->
                     
                        <div class="row">
                          <div class="mb-3 col-md-4">
                            <label for="Nombre" class="form-label">Nombre</label>
                            <input class="form-control" type="text" id="Nombre" name="Nombre"  autofocus required />
                          </div>
                          <div class="mb-3 col-md-4">
                            <label for="Apellido" class="form-label">Apellido</label>
                            <input class="form-control" type="text" name="Apellido" id="Apellido"  required />
                          </div>
                          
                        </div>

                        <div class="row">
                        <div class="mb-3 col-md-3">
                            <label for="Telefono1" class="form-label">Telefono 1</label>
                            <input class="form-control" type="text" id="Tele1" name="Tele1"  autofocus required />
                          </div>
                          <div class="mb-3 col-md-3">
                            <label for="Telefono2" class="form-label">Telefono 2</label>
                            <input class="form-control" type="text" name="Tele2" id="Tele2"  required />
                          </div>
                          <div class="mb-3 col-md-3">
                            <label for="Email" class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" id="email"  required />
                          </div>
                          <div class="mb-3 col-md-3">
                            <label for="Observacion" class="form-label">Observacion</label>
                            <input class="form-control" type="text" name="observacione" id="observacion"  required />
                          </div>
                        </div>
                        
                        <div class="row">
   
                        <div class="mb-3 col-md-3">
                            
                            <label for="Calle" class="form-label">Calle</label>
                            <input class="form-control" type="text" id="Calle" name="Calle"   />
                          
                        </div>
                        <div class="mb-3 col-md-1">
                            
                            <label for="Altura" class="form-label">Altura</label>
                            <input class="form-control" type="text" id="Altura" name="Altura"   />
                          
                        </div>
                        <div class="mb-3 col-md-1">
                            
                            <label for="CP" class="form-label">CP</label>
                            <input class="form-control" type="text" id="CP" name="CP"   />
                          
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="Provincia">Provincia</label>
                            <select id="Provincia"  name="Provincia" class="select2 form-select" >
                              <option value=""></option>
                              <?php 
                                foreach ($provincias as $id_prov =>$val) {
                                echo "<option value =". $id_prov . " > ". $val . "</option>";
                              }    ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="Ciudad">Ciudad</label>
                            <select id="Ciudad"  name="Ciudad" class="select2 form-select" >
                              
                            </select>
                          </div>

                        

                          
                          
                          
                          </div>
                         
                          
                          
                        </div>
                       
          
                   
                    
                        
                        <div class="mt-2">
                          <button type="submit" name="DarAlta" class="btn btn-primary me-2">Dar Alta</button>
                          
                       
                      
                    </div>

                     
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
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
      </form>
  </body>
</html>
